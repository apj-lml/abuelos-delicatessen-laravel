<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        return view('home');
    }

    public function myOrders()
    {
        return view('my-orders');
    }

    public function myCanceledOrders()
    {
        return view('my-canceled-orders');
    }

    public function myFulfilledOrders()
    {
        return view('my-fulfilled-orders');
    }

    public function manageOrders()
    {
        return view('manage-orders');
    }

    public function canceledOrders()
    {
        return view('canceled-orders');
    }

    public function fulfilledOrders()
    {
        return view('fulfilled-orders');
    }

    public function viewProduct()
    {
        return view('view-product');
    }
}
