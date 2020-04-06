<?php

namespace App\Http\Controllers;

use App\About;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\App;

class WelcomeController extends Controller
{
    public function index()
    {
        $menu = [
            (object)[
                'url' => '#',
                'title' => 'Home'
            ], (object)[
                'url' => '#',
                'title' => 'Woman'
            ], (object)[
                'url' => '#',
                'title' => 'Man'
            ], (object)[
                'url' => '#',
                'title' => 'LOOKBOOK'
            ], (object)[
                'url' => '#',
                'title' => 'BLOG'
            ], (object)[
                'url' => '#',
                'title' => 'CONTACT'
            ], (object)[
                'url' => 'tr/giris',
                'title' => 'Login / Register'
            ]
        ];

        $logoUrl = '/public/virus.png';

        $siteData = About::find(1);
        $category = Category::where('active', 1)->where('upId', '!=', 'null')->limit(3)->get();

        $products = Product::where('active', 1)->get();

        return view('home',[
            'menu' => (object)$menu,
            'logoUrl' => $logoUrl,
            'siteData' => $siteData,
            'category' => $category,
            'products' => $products
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