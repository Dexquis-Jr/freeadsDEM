<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ads::all();
        return view('indexUser', compact('ads'));

    }

       public function indexOther()
    {
        $ads = Ads::paginate(10);
        return view('welcome', compact('ads'));

    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'description' => 'required|max:255',
            'price' => 'required|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif',
            'location' => 'required|max:255',
        ]);

        $imgPath = null;
        if ($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('ads', 'public');
        }

        Ads::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $imgPath,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        // event(new Registered($ads));

        // return redirect()->back();

        // return redirect(route('dashboard'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ad)
    {
        $ad->load('user','category');
       return view('adsDeatil', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ads $ad)
    {
        // $ads = Ads::findOrFail($ads);
        $categories = Category::All();
        return view('editAds', compact('ad', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ads $ad)
    {


        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'location' => 'required|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('ads', 'public');
            $validated['photo'] = $path;
        }

        $ad->update($validated);

        // return redirect()->back();
        if(Auth()->user()->role === 'admin'){

        return redirect(route('dashboard'));

        }elseif(Auth()->user()->role === 'user'){
            return redirect(route('dashboardUser'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ads $ad)
    {
        $ad->delete();

          return redirect()->back();
    }
}