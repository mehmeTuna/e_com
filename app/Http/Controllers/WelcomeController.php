<?php

namespace App\Http\Controllers;

use App\About;
use App\Category;
use App\Features;
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
            'cartCount' => count(session('cart', [])),
            'cartItems' => session('cart', []),
            'cartTotal' => session('cartTotal', 0)
        ];
    }

    public function showPage($sLugName, Request $request)
    {
        $commonData = $this->getCommonData();

        $product = Product::where('active', 1)->where('nameSlug', $sLugName)->first();
        if($product == null){
            return $this->showCategoryPage($sLugName, $commonData, $request);
        }

        $otherProducts = Product::where('active', 1)->where('categoryId', $product->categoryId)->limit(6)->get();
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

    public function showCategoryPage($sLugName, $commonData, $request)
    {
        $price = isset($request->price) ? $request->price : '' ;
        $category = Category::where('active', 1)->where('nameSlug', $sLugName)->first();
        $features = Features::where('active', 1)->get();

        if($category == null){
            return redirect('/');
        }

        $products = null ;
        switch ($price){
            case 'plus':
                $products = $category->products()->orderBy('price', 'ASC')->get();
                break;
            case 'minus':
                $products = $category->products()->orderBy('price', 'DESC')->get();
                break;
            default :
                if(isset($request->minPrice) && isset($request->maxPrice)){
                    $products = $category->products()->whereBetween('price', [$request->minPrice, $request->maxPrice])->get();
                }else{
                    $products = $category->products;
                }
                break;
        }

        if($products == null){
            return redirect('/');
        }

        return view('categoryPage', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'category' => $category,
            'productItems' => $products,
            'features' => $features
        ]);
    }

    public function addCartItem(Request $request)
    {
       //TODO::request e kontrol eklenecek
       //TODO: bir sonraki asamada sepeti optimize et
        $cart = session('cart', []);
        $cartTotal = session('cartTotal', 0);
        $product = Product::find($request->productId);
        $items = $product->featuresItems ;
        $quantity = (int)$request->productQuantity < $product->minorders ? $product->minorders :  $request->productQuantity;
        $price = $product->price * $quantity;
        $options = ['checkBox' => [], 'selectBox' => []];
        $isOption= false ;

        if($product == null){
            return response()->json(['status' => false , 'text'=> 'urun bulunamadi']);
        }

        foreach ($items as $value){
            if($value->id == $request->checkBox){
                $isOption = true;
                $price = $quantity * $value->price ;
                array_push($options['checkBox'], [
                    'id' => $value->id,
                    'name' => $value->name,
                    'quantity' => $quantity
                ]);
            }else if($value->id == $request->selectBox){
                $isOption = true ;
                array_push($options['selectBox'], [
                    'id' => $value->id,
                    'name' => $value->name,
                    'quantity' => $quantity
                ]);
            }
        }

        $isAlreadyProduct = false ;
        for ($count = 0 ; $count < count($cart) ; $count++){
            if($cart[$count]['id'] == $product->id){
                $isAlreadyProduct = true ;

                if($isOption == false){
                    $cart[$count]['quantity'] = $cart[$count]['quantity'] + $quantity ;
                }

                $cart[$count]['price'] = $cart[$count]['price'] + $price ;
                if(isset($options['selectBox']) && count($options['selectBox'])){
                    array_push($cart[$count]['options']['selectBox'], $options['selectBox']);
                }
                if(isset($options['checkBox']) && count($options['checkBox'])){
                    array_push($cart[$count]['options']['checkBox'], $options['checkBox']);
                }
            }
        }

        if($isAlreadyProduct == false){
            array_push($cart, [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $isOption == false ? $quantity : 0,
                'price' => $price,
                'img' => $product->img,
                'options' => $options
            ]);
        }

        session()->pull('cart');
        session()->put('cart', $cart);
        session()->pull('cartTotal');
        session()->put('cartTotal', $cartTotal + $price);
        return response()->json([
            'cart' => $cart,
             'cartTotal' => $cartTotal + $price
        ]);
    }

    public function myAccountPage()
    {
        //TODO: kullanici hesabim sayfasi ve guncelleyebilecegi kisimlar
    }

    public function sepet()
    {
        $commonData = $this->getCommonData();

        return view('sepet',[
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
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