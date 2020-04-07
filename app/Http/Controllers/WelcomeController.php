<?php

namespace App\Http\Controllers;

use App\About;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\App;

class WelcomeController extends Controller
{
    public function demov()
    {
        return view('detay');
    }

    public function index()
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

        $products = Product::where('active', 1)->get();

        return view('home', [
            'logoUrl' => $logoUrl,
            'siteData' => $siteData,
            'categories' => $categories,
            'products' => $products,
            'cartCount' => 0,
            'cartItems' => [],
            'cardTotal' => 0
        ]);
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