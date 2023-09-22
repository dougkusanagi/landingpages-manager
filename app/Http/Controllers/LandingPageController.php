<?php

namespace App\Http\Controllers;

use App\Models\landingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return inertia('LandingPage/index', [
            'landing_pages' => LandingPage::all(),
        ]);
    }

    public function store(Request $request)
    {
        landingPage::create($request->all());

        return redirect()->route('landing-page.index')
            ->with('success', 'Landing Page criada com sucesso.');
    }

    public function edit(landingPage $landingPage)
    {
        return inertia('LandingPage/edit', [
            'landing_page' => $landingPage
        ]);
    }

    public function update(Request $request, LandingPage $landingPage)
    {
        dd($request->all());

        $landingPage->update($request->all());

        return redirect()->route('landing-page.index')
            ->with('success', 'Landing Page atualizada com sucesso.');
    }

    public function load(landingPage $landingPage)
    {
        return response()->json([
            'data' => $landingPage->data
        ]);
    }

    public function updateTemplate($id)
    {
        $page = request('pagesHtml')[0];

        landingPage::find($id)
            ->update([
                'html' => $page['html'],
                'css' => $page['css'],
                'data' => request('data'),
            ]);

        return response('', 200);
    }

    public function destroy(landingPage $landingPage)
    {
        //
    }
}
