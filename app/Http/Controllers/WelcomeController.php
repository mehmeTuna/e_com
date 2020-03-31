<?php

namespace App\Http\Controllers;

use App\About;
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
            ]
        ];

        $logoUrl = '/public/virus.png';

        return view('home',[
            'menu' => (object)$menu,
            'logoUrl' => $logoUrl
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