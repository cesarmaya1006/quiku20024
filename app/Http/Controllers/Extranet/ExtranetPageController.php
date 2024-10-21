<?php

namespace App\Http\Controllers\Extranet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ExtranetPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('extranet.index.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function registro()
    {
        return view('extranet.register.registro');
    }
    public function loginapp()
    {
        return view('extranet.logins.login1');
    }

    public function register(Request $request)
    {
        User::create($request->all());
        return redirect('/loginapp')->with('mensaje', 'Usuario creado con éxito');
    }
}
