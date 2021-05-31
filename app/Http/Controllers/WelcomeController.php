<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->take(100)->get();
        $oldests = Profile::oldest()->take(100)->get();

        return view('welcome.index', compact('profiles', 'oldests'));
    }
}
