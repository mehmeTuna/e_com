<?php

namespace App\Http\Controllers;

use App\About;
use App\Admin;
use App\Category;
use App\Features;
use App\Http\Requests\SiteUpdateDataRequest;
use App\Orders;
use App\Product;
use FastExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use PDF;

class AdminController extends Controller
{

    public function loginPage()
    {
        return view('yonetim.loginPage');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required|min:3|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'text' => 'Gecerli bir email ve parola giriniz',
            ]);
        }

        $admin = Admin::where('username', $request->username)->get();

        if (!isset($admin[0])) {
            return response()->json([
                'status' => false,
                'text' => 'Kullanıcı adı ve parola hatalı',
            ]);
        }

        if (!Hash::check($request->password, $admin[0]->password)) {
            return response()->json([
                'status' => false,
                'text' => 'Parola Hatalı',
            ]);
        }

        session()->put('admin', $admin[0]->id);

        return response()->json([
            'status' => true,
            'text' => 'is login',
            'url' => '/yonetim',
        ]);
    }

    public function logout()
    {
        if (session()->has('admin')) {
            session()->forget('admin');
            return response()->json([
                'status' => true,
                'text' => 'is logut',
            ]);
        }

        return response()->json([
            'status' => true,
            'text' => 'Ooooops',
        ]);
    }

    public function home()
    {
        return view('yonetim.home');
    }

    public function categoryList()
    {
        $category = Category::where('active', 1)->where('upId', null)->get();

        $category = $category->map(function ($data) {
            $result = (object) [];
            $result->id = $data->id;
            $result->img = $data->img;
            $result->name = $data->name;
            $result->downCategory = Category::where('active', 1)->where('upId', $data->id)->get();
            $result->count = Product::where('active', 1)->where('categoryId', $data->id)->count();
            return $result;
        });

        return response()->json([
            'status' => true,
            'data' => $category,
        ]);
    }

    public function allCategory()
    {
        $category = Category::where('active', 1)->get();

        $category = $category->map(function ($data) {
            $result = (object) [];
            $result->id = $data->id;
            $result->img = $data->img;
            $result->name = $data->name;
            return $result;
        });

        return response()->json([
            'status' => true,
            'data' => $category,
        ]);
    }

    public function categoryDelete(Request $request)
    {
        $result = Category::where('active', 1)->where('id', $request->id)->first();

        $result->update([
            'active' => 0,
        ]);

        $result->save();

        return response()->json([
            'status' => true,
        ]);
    }

    public function categoryCreate(Request $request)
    {
        $img = [];

        if ($request->hasFile('img0')) {
            $image = $request->file('img0');
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $img[0] = '/public/images/' . $name;
        }

        $category = Category::create([
            'name' => $request->name,
            'nameSlug' => str_slug($request->name),
            'upId' => $request->upId,
            'img' => isset($img[0]) ? $img[0] : null,
        ]);

        return response()->json([
            'status' => true,
        ]);
    }

    public function productCreate(Request $request)
    {
        $productName = $request->name;
        $category = $request->category;
        $quantity = $request->quantity < 0 ? 1 : $request->quantity;
        $price = $request->price;
        $content = $request->cardText;
        $code = $request->code;
        $minorders = $request->minorders;
        $img = [];

        if ($request->hasFile('img0')) {
            $image = $request->file('img0');
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $img[0] = '/public/images/' . $name;
        }

        if ($request->hasFile('img1')) {
            $image = $request->file('img1');
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $img[1] = '/public/images/' . $name;
        }

        if ($request->hasFile('img2')) {
            $image = $request->file('img2');
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $img[2] = '/public/images/' . $name;
        }

        if ($request->hasFile('img3')) {
            $image = $request->file('img3');
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $img[3] = '/public/images/' . $name;
        }

        $product = Product::create([
            'price' => $price,
            'name' => $productName,
            'nameSlug' => str_slug($productName),
            'quantity' => $quantity,
            'categoryId' => $category,
            'content' => $content,
            'img' => $img[0],
            'otherImg' => $img,
            'code' => $code,
            'minorders' => (int) $minorders,
        ]);

        $selectBox = [];
        try {
            $selectBox = json_decode($request->selectBox);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }

        foreach ($selectBox as $value) {
            $features = Features::create([
                'product_id' => $product->id,
                'name' => $value->title,
                'type' => 'selectBox',
                'price' => $product->price,
            ]);
        }

        $checkBox = [];
        try {
            $checkBox = json_decode($request->checkBox);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }

        foreach ($checkBox as $value) {
            $features = Features::create([
                'product_id' => $product->id,
                'name' => $value->title,
                'type' => 'checkBox',
                'price' => $value->price,
            ]);
        }

        return response()->json([
            'status' => true,
        ]);

    }

    public function productDelete(Request $request)
    {
        $id = $request->id;

        $data = Product::where('id', $id)->update(['active' => 0]);

        return response()->json([
            'status' => true,
        ]);
    }

    public function productList()
    {
        $product = Product::where('active', 1)->orderBy('created_at', 'desc')->get();

        $result = $product->map(function ($val) {
            $data = (object) [];
            $category = Category::where('id', $val->categoryId)->first();
            $data->id = $val->id;
            $data->code = $val->code;
            $data->img = $val->img;
            $data->name = $val->name;
            $data->minorders = $val->minorders;
            $data->content = $val->content;
            $data->date = $val->created_at->toDateString();
            $data->category = $category->name;
            $data->stok = $val->quantity;
            $data->price = $val->price;
            $data->selectBox = Features::where('active', 1)->where('type', 'selectBox')->where('product_id', $val->id)->get();
            $data->checkBox = Features::where('active', 1)->where('type', 'checkBox')->where('product_id', $val->id)->get();
            return $data;
        });

        return response()->json([
            'status' => true,
            'data' => $result,
        ]);
    }

    public function newAbout(SiteUpdateDataRequest $request)
    {

        $about = About::where('id', 1)->update((array) $request->all());

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function galleryUpdate(Request $request)
    {
        $data = (array) $request->all();
        $gallery = [];
        foreach ($data as $key => $value) {
            $image = $request->file($key);
            if ($image == null) {
                continue;
            }
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($gallery, ['url' => '/public/images/' . $name]);
        }

        $about = About::where('id', 1)->update(['gallery' => json_encode($gallery)]);

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function logoUpdate(Request $request)
    {
        $data = (array) $request->all();
        $gallery = [];
        foreach ($data as $key => $value) {
            $image = $request->file($key);
            if ($image == null) {
                continue;
            }
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($gallery, ['url' => '/public/images/' . $name]);
        }

        $about = About::where('id', 1)->update(['logo' => json_encode($gallery)]);

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function sliderUpdate(Request $request)
    {
        $data = (array) $request->all();
        $gallery = [];
        foreach ($data as $key => $value) {
            $image = $request->file($key);
            if ($image == null) {
                continue;
            }
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            array_push($gallery, ['url' => '/public/images/' . $name]);
        }

        $about = About::where('id', 1)->update(['slider' => json_encode($gallery)]);

        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function getAboutDAta()
    {
        return About::find(1);
    }

    public function getAbout()
    {
        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);
    }

    public function orderDelete(Request $request)
    {
        $id = $request->id;

        $order = Orders::find($id);
        if ($order == null) {
            return response()->json([
                'status' => false,
            ]);
        }

        $order->m_status = 0;
        $order->save();

        return response()->json([
            'status' => true,
        ]);
    }

    public function orderConfirmation(Request $request)
    {
        $id = $request->id;
        $type = $request->type ;
        $company = $request->company;
        $trackingNumber = $request->trackingNumber;

        $order = Orders::find($id);
        if ($order == null) {
            return response()->json([
                'status' => false,
            ]);
        }
        if($type == 'iptal'){
            $order->m_status = 2;
        }
        if($type == 'onay'){
            $order->m_status = 1;
            $order->company = $company;
            $order->trackingNumber = $trackingNumber;
        }

        $order->save();

        return response()->json([
            'status' => true,
        ]);
    }

    public function getOrders(Request $request)
    {
        $status = 0;
        
        switch ($request->type){
            case 'coming':
                $status = 0;
                break;
            case 'approved':
                $status = 1;
            break;
            case 'cancel';
                $status =2;
            break;
        }

        $orders = Orders::where('orders.m_status',$status)->with(['user', 'status', 'items', 'items.product', 'items.selectBox','items.checkBox', 'items.product.category'])->get();

        return response()->json([
            'status' => true,
            'data' => $orders,
        ]);
    }

    public function ordersInvoice()
    {

        $html = view('orders.ordersInvoiceTemplate')->render();

        return PDF::load($html)->show();

    }

    public function excel()
    {
        $orders = Orders::all();

        // Export all users
        return (new FastExcel($orders))->download('file.xlsx');
    }

}