<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dummies extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

   public function dashboard()
   {
        return view('cafe/tes');
   }
}
