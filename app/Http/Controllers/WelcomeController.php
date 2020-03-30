<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Support\Facades\App;

class WelcomeController extends Controller
{

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

    public function index()
    {
        //$about = About::where('id', 1)->active()->first();

        return view('home');
    }

}