<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function newOrder()
    {
        return view('new-order'); 
    }
     public function vieworder()
    {
        return view('order-view'); 
    }
}
