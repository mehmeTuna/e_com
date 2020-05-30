<?php

namespace App\Providers;

use App\Cart;
use App\Observers\CartObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use App\About;
use App\Brands;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Cart::observe(CartObserver::class);

        $resultData = $this->getCommonData();

        View::share('logoUrl', $resultData->logoUrl);
        View::share('siteData', $resultData->siteData);
        View::share('categories', $resultData->categories);
        View::share('cartCount', $resultData->cartCount);
        View::share('cartItems', $resultData->cartItems);
        View::share('cartTotal', $resultData->cartTotal);
        View::share('brands', $resultData->brands);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

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
}
