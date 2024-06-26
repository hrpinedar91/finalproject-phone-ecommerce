<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $books = Phone::all();

        return view('index', compact('categories', 'phones'));
    }
}
