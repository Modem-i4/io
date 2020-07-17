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
        
        return view('home');
        /**if(Auth::user()->isAdmin()) {
            return redirect()->route('admin');
        }
        else {
            return redirect()->route('user');
        }**/
    }
    public function admin()
    {
        
        return view('inventory.admin.index');

    }
}
