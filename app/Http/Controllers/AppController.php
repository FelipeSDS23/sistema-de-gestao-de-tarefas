<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function index() {
        return view('app.dashboard');
    }

    // public function config(string $id) {
    public function config() {
        return view('app.config');
    }
}
