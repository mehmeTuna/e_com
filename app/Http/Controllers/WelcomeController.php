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

    public function comingSoon()
    {
        return view('comingSoon');
    }

    public function showPage($sLugName, Request $request)
    {

        $product = Product::where('active', 1)->where('nameSlug', $sLugName)->first();
        if ($product == null) {
            return $this->showCategoryPage($sLugName, $request);
        }

        $otherProducts = Product::where('active', 1)->with(['category', 'featuresItems'])->where('categoryId', $product->categoryId)->limit(6)->get();
        return view('productDetail', [
            'product' => $product,
            'productCategory' => $product->category,
            'features' => $product->featuresItems,
            'otherProducts' => $otherProducts,
        ]);
    }

    public function showCategoryPage($sLugName, $request)
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
            'category' => $category,
            'productItems' => $products,
            'features' => $features,
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
            'user' => $user,
            'orders' => $orders,
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
        return view('sepet');
    }

    public function search($search)
    {
        $products = Product::where('active', 1)->where('name', 'LIKE', '%' . $search . '%')->get();

        if ($products == null) {
            return redirect('/');
        }

        return view('categoryPage', [
            'productItems' => $products,
            'features' => Features::where('active', 1)->limit(6)->get(),
        ]);
    }

    public function index()
    {
        $products = Product::where('active', 1)->get();
        $instagramUsername = 'iskenderun.xyz';
     //   $instagram = $this->getInstagramImages($instagramUsername);
    //    $instagram['dd_username'] = $instagramUsername ;

        return view('home', [
            'products' => $products,
            'yeniEklenenler' => Product::with('categories')->where('active', 1)->limit(15)->orderBy('created_at', 'ASC')->get(),
            'blogs' => Blogs::where('active', 1)->get()
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
        session()->forget(User::SESSION_NAME);
        return redirect('/');
    }

    public function blogCreate(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|min:2',
            'title' => 'required|min:2',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);

         $img = '';
         if ($request->hasFile('img')) {
            $image = $request->file('img');
            $name = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $img = '/public/images/' . $name;
        }

        Blogs::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'url'  => Str::limit($request['title'], 10),
            'img' => $img
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
        $content = Blogs::where('url', $request->slug)->where('active', 1)->first();

        if($content == null){
            return redirect('/');
        }

        return view('blog.detail', [
            'content' => $content,
           ]);
    }

    public function articleList(){
        $articles = Blogs::where('active', 1)->limit(60)->get();

        return view('blog.list', [
            'articles' => $articles,
        ]);
    }
}