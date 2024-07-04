<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $aboutInformation = About::first();
        $user = User::find(Auth::user()->id);
        $userIsAdmin = $user->isAdministrator();

        return view('about.index', ['about' => $aboutInformation, 'admin' => $userIsAdmin]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(about $about) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(about $about) {
        $aboutInformation = About::first();
        return view('about.edit', ['about' => $aboutInformation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, about $about) {
        $aboutInformation = About::first();

        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'summary' => 'string|max:16000',
            'link' => 'string|max:255',
        ]);

        try {
            $aboutInformation->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->route('about.index')->with('error', 'Failed to update about');
        }

        return redirect()->route('about.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(about $about) {
        //
    }
}
