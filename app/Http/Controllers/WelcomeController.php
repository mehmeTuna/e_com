<?php

namespace App\Http\Controllers;

use App\About;
use App\Category;
use App\Product;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WelcomeController extends Controller
{

    public function getCommonData()
    {
        $logoUrl = '/public/virus.png';
        $cartCount = 0;
        $cartItems = [];
        $cartTotal = 0;

        $siteData = About::find(1);
        $categories = Category::where('active', 1)->where('upId',  null)->limit(15)->get();

        $categories = $categories->map(function($value){
            $data = (object)[];
            $data->name = $value->name ;
            $data->slug = $value->nameSlug ;
            $data->img = $value->img ;
            $data->subCategory = Category::where('active', 1)->where('upId', $value->id)->get();
            $data->subCategory = $data->subCategory->map(function($value){
                $data = (object)[];
                $data->name = $value->name ;
                $data->slug = $value->nameSlug ;
                $data->img = $value->img ;
                return $data ;
            });
            return $data;
        });

        return (object)[
            'logoUrl' => $logoUrl,
            'siteData' => $siteData,
            'categories' => $categories,
            'cartCount' => $cartCount,
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal
        ];
    }

    public function productPage($productSLugName)
    {
        $commonData = $this->getCommonData();
        $product = Product::where('active', 1)->where('nameSlug', $productSLugName)->first();
        if($product == null){
            return redirect('/');
        }

        $otherProducts = Product::where('active', 1)->where('categoryId', $product->categoryId)->get();

        return view('productDetail',[
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'product' => $product,
            'productCategory' => $product->category,
            'features' => $product->featuresItems,
            'otherProducts' => $otherProducts
        ]);
    }

    public function index()
    {
        $commonData = $this->getCommonData();
        $products = Product::where('active', 1)->get();

        return view('home', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'products' => $products,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal
        ]);
    }

    public function registerPage()
    {
        $commonData = $this->getCommonData();

        return view('register', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal
        ]);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullName' => 'required|min:3|max:255',
            'username' => 'required|unique:users,email',
            'password' => 'required|min:4|max:25',
            'address' => 'required|min:3|max:100',
        ]);


        if($validator->fails() || $request->contract != true){
            return redirect('/kayit-ol');
        }

        $user = User::create([
            'firstname' => $request->fullName,
            'lastname' => '',
            'verification_code' => str_random(10),
            'phone' => '',
            'email' => $request->username,
            'password' => Hash::make($request->password),
            'adress' => $request->address,
        ]);

        session()->put('userId', $user->id);

        return redirect('/');

    }

    public function loginPage()
    {
        $commonData = $this->getCommonData();

        return view('login', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal
        ]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required|min:4|max:25',
        ]);


        if($validator->fails() ){
            return redirect('/giris');
        }

        $user = User::where( 'email' ,$request->username)->first();

        if (!Hash::check($request->password, $user->password)){
            return redirect('/giris') ;
        }

        session()->put('userId', $user->id);

        return redirect('/');

    }

    public function logOut(){
        session()->forget('userId');
        return redirect('/');
    }

    public function noPage()
    {
        return view('404');
    }

    public function about()
    {

        $about = About::where('id', 1)->active()->first();

        return view('about', [
            'data' => $about,
        ]);
    }

    public function gallery()
    {
        $about = About::where('id', 1)->active()->first();

        return view('gallery', [
            'data' => $about,
        ]);
    }
}