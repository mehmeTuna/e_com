<?php

namespace App\Http\Controllers;

use App\About;
use App\Admin;
use App\Category;
use App\Features;
use App\Http\Requests\SiteUpdateDataRequest;
use App\Orders;
use App\Product;
use App\Blogs;
use FastExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use App\ProductCategory; 
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
        $updateProduct = [];
        $updateProduct['name'] = $request->name;
        $updateProduct['nameSlug'] = str_slug($request->name);

    
        $updateProduct['content'] = $request->cardText;
        $imgList = [
            'img0',
            'img1',
            'img2',
            'img3'
        ] ;
        $img = [];

        foreach($imgList as $value){
            if ($request->hasFile($value)) {
                $image = $request->file($value);
                $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $img[] = '/public/images/' . $name;
            }    
        }
        $updateProduct['otherImg'] = $img ;
        $updateProduct['img'] = $img[0];

        $product = Product::create($updateProduct);

        $options = json_decode($request->options, true);
        foreach($options as $key => $value){
            $feature = Features::create([
                'product_id' => $product->id,
                'name' => $value['title'],
                'quantity' => $value['stock'],
                'min_order' => $value['minOrders'],
                'price' => $value['price'],
            ]);
        }

        $category = json_decode($request->category, true);
        foreach($category as $key => $value){
            $category = ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $value['id']

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
        \DB::connection()->enableQueryLog();
      
        $product = Product::where('active', 1)->with(['categories.category', 'featuresItems'])->orderBy('created_at', 'desc')->get();
        $queries = \DB::getQueryLog();
        //return dd($queries);

        return response()->json([
            'status' => true,
            'data' => $product,
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