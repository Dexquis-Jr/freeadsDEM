<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisplayUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $ads = Ads::with(['user', 'category'])->get();
        $categories = Category::All();

        $totalUsers = User::count();
        $totalAds = Ads::count();
        $totalCategories = Category::count();
        $adsToday = Ads::whereDate('created_at', today())->count();

        return view('dashboard', compact('users', 'ads', 'categories', 'totalUsers', 'totalAds', 'totalCategories', 'adsToday'));
        // return view('dashboard', [
        //     'user' => $request->user(),
        //     'users' => $users,
        // ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard')->with('succès', 'Utilisateur supprimé');

    }

    public function edit(User $user)
    {
        return view('editUser', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string',
            'role' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard')
            ->with('succèss', 'Utilisateur modifié');
    }

    public function show(User $user) {
        return view('userDetail', compact('user'));
    }
}
