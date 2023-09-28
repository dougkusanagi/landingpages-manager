<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Services\BuildLandingPageFiles;
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
        LandingPage::create($request->all());

        return to_route('landing-page.index')
            ->with('success', 'Landing Page criada com sucesso.');
    }

    public function edit(LandingPage $landingPage)
    {
        return inertia('LandingPage/edit', [
            'landing_page' => $landingPage
        ]);
    }

    public function update(Request $request, LandingPage $landingPage)
    {
        // dd($request->all());

        $landingPage->update($request->all());

        return to_route('landing-page.edit', $landingPage)
            // to_route('landing-page.index')
            ->with('success', 'Landing Page atualizada com sucesso.');
    }

    public function load(LandingPage $landingPage)
    {
        return response()->json([
            'data' => $landingPage->data
        ]);
    }

    public function updateTemplate($id)
    {
        $page = request('pagesHtml')[0];

        LandingPage::find($id)
            ->update([
                'html' => $page['html'],
                'css' => $page['css'],
                'data' => request('data'),
            ]);

        return response('', 200);
    }

    public function uploadFtp(LandingPage $landingPage)
    {
        return (new BuildLandingPageFiles)($landingPage);
    }

    public function destroy(LandingPage $landingPage)
    {
        //
    }
}
