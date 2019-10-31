<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIndex()
    {
        return view('admin.index');
    }
    public function sellerIndex()
    {
        return view('seller.index');
    }
    public function sellerInactive()
    {
        return view('seller.inactive');
    }
    public function sellerRegister()
    {
        return view('auth.sellerRegistration');
    }
}
