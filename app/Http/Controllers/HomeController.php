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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function clientes()
    {
        return view('clientes');
    }
    
    public function processos()
    {
        return view('processos');
    }
    
    public function construcao()
    {
        return view('construcao');
    }
}
