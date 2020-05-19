<?php

namespace App\Http\Controllers;

use App\About;
use App\Brands;
use App\Category;
use App\Features;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests;
use App\Product;
use App\User;
use App\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{

    public function getCommonData()
    {
        $siteData = About::find(1);
        $logoUrl = $siteData->logo[0]->url;
        $categories = Category::where('active', 1)->where('upId', null)->limit(6)->get();
        $brands = Brands::where('active', 1)->get();

        $categories = $categories->map(function ($value) {
            $data = (object) [];
            $data->name = $value->name;
            $data->slug = $value->nameSlug;
            $data->img = $value->img;
            $data->subCategory = Category::where('active', 1)->where('upId', $value->id)->get();
            $data->subCategory = $data->subCategory->map(function ($value) {
                $data = (object) [];
                $data->name = $value->name;
                $data->slug = $value->nameSlug;
                $data->img = $value->img;
                return $data;
            });
            return $data;
        });

        return (object) [
            'logoUrl' => $logoUrl,
            'siteData' => $siteData,
            'categories' => $categories,
            'cartCount' => count(session('cart', [])),
            'cartItems' => session('cart', []),
            'cartTotal' => session('cartTotal', 0),
            'brands' => $brands
        ];
    }

    public function showPage($sLugName, Request $request)
    {
        $commonData = $this->getCommonData();

        $product = Product::where('active', 1)->where('nameSlug', $sLugName)->first();
        if ($product == null) {
            return $this->showCategoryPage($sLugName, $commonData, $request);
        }

        $otherProducts = Product::where('active', 1)->with(['category', 'featuresItems'])->where('categoryId', $product->categoryId)->limit(6)->get();
        return view('productDetail', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'product' => $product,
            'productCategory' => $product->category,
            'features' => $product->featuresItems,
            'otherProducts' => $otherProducts,
            'brands' => $commonData->brands
        ]);
    }

    public function showCategoryPage($sLugName, $commonData, $request)
    {
        $price = isset($request->price) ? $request->price : '';
        $category = Category::where('active', 1)->where('nameSlug', $sLugName)->first();
        $features = Features::where('active', 1)->limit(6)->get();

        if ($category == null) {
            return redirect('/');
        }

        $products = null;
        switch ($price) {
            case 'plus':
                $products = $category->products()->orderBy('price', 'ASC')->get();
                break;
            case 'minus':
                $products = $category->products()->orderBy('price', 'DESC')->get();
                break;
            default:
                if (isset($request->minPrice) && isset($request->maxPrice)) {
                    $products = $category->products()->whereBetween('price', [$request->minPrice, $request->maxPrice])->get();
                } else if (isset($request->option)) {
                    $products = $category->products()->get();
                } else {
                    $products = $category->products;
                }
                break;
        }

        if ($products == null) {
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
            'features' => $features,
            'brands' => $commonData->brands
        ]);
    }

    public function addCartItem(Request $request)
    {
        //TODO::request e kontrol eklenecek
        //TODO: bir sonraki asamada sepeti optimize et
        $cart = session('cart', []);
        $cartTotal = session('cartTotal', 0);
        $product = Product::find($request->productId);
        $items = $product->featuresItems;
        $quantity = (int) $request->productQuantity < $product->minorders ? $product->minorders : $request->productQuantity;
        $price = $product->price * $quantity;
        $options = ['checkBox' => [], 'selectBox' => []];
        $isOption = false;

        if ($product == null) {
            return response()->json(['status' => false, 'text' => 'urun bulunamadi']);
        }

        foreach ($items as $value) {
            if ($value->id == $request->checkBox) {
                $isOption = true;
                $price = $quantity * $value->price;
                array_push($options['checkBox'], [
                    'id' => $value->id,
                    'name' => $value->name,
                    'quantity' => $quantity,
                ]);
            } else if ($value->id == $request->selectBox) {
                $isOption = true;
                array_push($options['selectBox'], [
                    'id' => $value->id,
                    'name' => $value->name,
                    'quantity' => $quantity,
                ]);
            }
        }

        $isAlreadyProduct = false;
        for ($count = 0; $count < count($cart); $count++) {
            if ($cart[$count]['id'] == $product->id) {
                $isAlreadyProduct = true;

                if ($isOption == false) {
                    $cart[$count]['quantity'] = $cart[$count]['quantity'] + $quantity;
                }

                $cart[$count]['price'] = $cart[$count]['price'] + $price;
                if (isset($options['selectBox']) && count($options['selectBox'])) {
                    array_push($cart[$count]['options']['selectBox'], $options['selectBox']);
                }
                if (isset($options['checkBox']) && count($options['checkBox'])) {
                    array_push($cart[$count]['options']['checkBox'], $options['checkBox']);
                }
            }
        }

        if ($isAlreadyProduct == false) {
            array_push($cart, [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $isOption == false ? $quantity : 0,
                'price' => $price,
                'img' => $product->img,
                'options' => $options,
            ]);
        }

        session()->pull('cart');
        session()->put('cart', $cart);
        session()->pull('cartTotal');
        session()->put('cartTotal', ($cartTotal + $price) < 0 ? 0 : ($cartTotal + $price));
        return response()->json([
            'cart' => $cart,
            'cartTotal' => $cartTotal + $price,
        ]);
    }

    public function deleteCartItem(Request $request)
    {
        if (!isset($request->productId)) {
            return response()->json([
                'status' => false,
            ]);
        }

        $id = (int) $request->productId;
        $cart = session('cart', []);
        $item = -1;
        $cartTotal = session('cartTotal', 0);
        $price = 0;

        for ($count = 0; $count < count($cart); $count++) {
            if ($cart[$count]['id'] == $id) {
                $item = $count;
                $price = $cart[$count]['price'];
                break;
            }
        }

        if ($item != -1) {
            array_splice($cart, $item, 1);

            $price = $cartTotal - $price;
        }

        session()->pull('cart');
        session()->put('cart', $cart);
        session()->pull('cartTotal');
        session()->put('cartTotal', round($price < 0 ? 0 : $price, 2));

        return response()->json([
            'status' => true,
        ]);
    }

    public function myAccountPage()
    {
        //TODO: kullanici hesabim sayfasi ve guncelleyebilecegi kisimlar
        $commonData = $this->getCommonData();
        $products = Product::where('active', 1)->get();
        $user = User::find(session('userId'));
        $orders = $user->orders()->get()->map(function($value){ //TODO:: bu kisimi iliskiye bagla ve dunzenle
            $data = (object)[];
            $product = Product::find($value['productId']);
            $data->durum = 'Hazirlaniyor';
            $data->id = $value['order_id'];
            $data->product = $product;
            $data->price = $value['price'];
            $data->date = $value['created_at'];
            $data->selectbox = $value['selectbox'] == null ? '' : $product->featuresItems()->where('features.type', 'selectBox')->where('features.id', $value['selectbox'])->first();
            $data->checkbox = $value['checkbox'] == null ? '' : $product->featuresItems()->where('features.type', 'checkBox')->where('features.id', $value['checkbox'])->first();
            return $data;
        });

        if ($user == null) {
            return redirect('/');
        }

        return view('myAccount', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'products' => $products,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'user' => $user,
            'orders' => $orders,
            'brands' => $commonData->brands
        ]);
    }

    public function userUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'adress' => 'sometimes|min:3|max:255',
            'email' => 'sometimes|email|unique:users',
            'phone' => 'sometimes|integer',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'status' => false,
                ]);
        }

        $user = User::find(session('userId'))->update($request->toArray());

        return response()
            ->json([
                'status' => true,
            ]);
    }

    public function sepet()
    {
        $commonData = $this->getCommonData();

        return view('sepet', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
        ]);
    }

    public function search($search)
    {
        $commonData = $this->getCommonData();
        $products = Product::where('active', 1)->where('name', 'LIKE', '%' . $search . '%')->get();

        if ($products == null) {
            return redirect('/');
        }

        return view('categoryPage', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'productItems' => $products,
            'features' => Features::where('active', 1)->limit(6)->get(),
            'brands' => $commonData->brands
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
            'yeniEklenenler' => Product::with('category')->where('active', 1)->orderBy('created_at', 'ASC')->get(),
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
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
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
        ]);
    }

    public function register(UserRegisterRequest $request)
    {
        if ( $request->contract != true) {
            return redirect('/kayit-ol');
        }

        $user = User::create([
            'firstname' => $request->fullName,
            'lastname' => '',
            'verification_code' => str_random(10),
            'phone' => $request->phone,
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
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->username)->first();

        if ($user == null || !Hash::check($request->password, $user->password)) {
            return redirect('/giris');
        }

        session()->put('userId', $user->id);

        return redirect('/');
    }

    public function logOut()
    {
        session()->forget('userId');
        return redirect('/');
    }

    public function noPage()
    {
        return view('404');
    }

    public function about()
    {
        $commonData = $this->getCommonData();

        return view('about', [
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
        ]);
    }

    public function gallery()
    {
        $about = About::find(1);

        return view('gallery', [
            'data' => $about,
        ]);
    }

    public function blogs()
    {
        return response()->json(Blogs::active()->orderBy('created_at', 'ASC')->get());
    }

    public function blogCreate(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|min:2',
            'title' => 'required|min:2'
         ]);

        Blogs::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'url'  => Str::limit($request['title'], 10)
        ]);

        return response()->json(['status' => true]);
    }

    public function blogDelete($id)
    {
        $blogs = Blogs::find($id)->update(['active' => 0]);

        return response()->json(['status' => true]);
    }

    public function showArticle(Request $request)
    {

        $commonData = $this->getCommonData();
        $content = Blogs::where('url', $request->slug)->where('active', 1)->first();

        if($content == null){
            return redirect('/');
        }

        return view('blog.detail', [
            'content' => $content,
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
        ]);
    }

    public function articleList(){
        $commonData = $this->getCommonData();
        $articles = Blogs::where('active', 1)->limit(60)->get();

        return view('blog.list', [
            'articles' => $articles,
            'logoUrl' => $commonData->logoUrl,
            'siteData' => $commonData->siteData,
            'categories' => $commonData->categories,
            'cartCount' => $commonData->cartCount,
            'cartItems' => $commonData->cartItems,
            'cartTotal' => $commonData->cartTotal,
            'brands' => $commonData->brands
        ]);
    }
}