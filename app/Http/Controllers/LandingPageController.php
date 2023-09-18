<?php

namespace App\Http\Controllers;

use App\Models\landingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('LandingPage/index', [
            'landing_pages' => LandingPage::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('LandingPage/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        landingPage::create($request->all());

        return redirect()->route('landing-page.index')
            ->with('success', 'Landing Page criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(landingPage $landingPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(landingPage $landingPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, landingPage $landingPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(landingPage $landingPage)
    {
        //
    }
}
