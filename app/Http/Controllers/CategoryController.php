<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function show(Category $category) {
        //dd($category);
        $now = Carbon::now();
        return view('provider.category', compact('category','now'));
    }
}
