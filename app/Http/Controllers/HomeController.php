<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function new()
    {
        return view('frontend.new');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function plans()
    {
        return view('frontend.plans');
    }

    public function imprint()
    {
        return view('frontend.imprint');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function trees()
    {
        return view('frontend.trees');
    }


}
