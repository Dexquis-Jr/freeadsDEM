<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DisplayAdsController extends Controller
{
   public function index()
    {
     $ads = Ads::where('user_id', auth()->id())->get();
     $categories = Category::All();

        return view('dashboardUser', compact('ads', 'categories'));
    }

     public function indexUser()
    {
     $ads = Ads::All();

        return view('indexUser', compact('ads'));
    }
}
