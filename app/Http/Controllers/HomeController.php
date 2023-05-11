<?php

namespace App\Http\Controllers;

use function compact;
use function view;

class HomeController extends Controller
{
    public function home()
    {
        // database => QB and ORM
        $product = [
            'name' => 'product one',
            'price' => '50'
        ];
        return view('home.home', compact('product'));
    }

    public function about($id = null)
    {
//        dd($id);
//        return view('home.about',[
//            'id' => $id
//        ]);
        return view('home.about', compact('id'));
    }

}
