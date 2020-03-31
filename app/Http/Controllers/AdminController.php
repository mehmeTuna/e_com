<?php

namespace App\Http\Controllers;

use App\About;
use App\Admin;
use App\Category;
use App\Http\Requests\SiteUpdateDataRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $nameEn = $request->nameEn;
        $category = $request->category;
        $quantity = $request->quantity < 0 ? 1 : $request->quantity;
        $price = $request->price;
        $content = $request->cardText;
        $code = $request->code;
        $features = $request->features;
        $contentEn = $request->contentEn;
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
            'trName' => $productName,
            'enName' => $nameEn,
            'quantity' => $quantity,
            'categoryId' => $category,
            'trContent' => $content,
            'img' => $img[0],
            'otherImg' => $img,
            'code' => $code,
            'features' => (int) $features,
            'enContent' => $contentEn,
        ]);

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
            $data->trName = $val->trName;
            $data->features = $val->features;
            $data->trContent = $val->trContent;
            $data->enContent = $val->enContent;
            $data->date = $val->created_at;
            $data->category = $category->trName;
            $data->stok = $val->quantity;
            $data->price = $val->price;
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
        return About::find( 1);
    }

    public function getAbout()
    {
        return response()->json([
            'status' => true,
            'data' => $this->getAboutDAta(),
        ]);

    }

}