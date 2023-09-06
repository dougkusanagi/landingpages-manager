<?php

namespace App\Http\Controllers;

use App\Models\ClonedLandingPage;
use App\Services\WebsiteClonerService;

class WebsiteCloneController extends Controller
{
    public function index()
    {
        return inertia('WebsiteClone/index', [
            'cloned_landing_pages' => ClonedLandingPage::all(),
        ]);
    }

    public function clone()
    {
        $website_clone = ClonedLandingPage::create([
            'url' => request('url'),
        ]);

        $website_cloner = new WebsiteClonerService('cloned-landingpages/' . $website_clone->id);
        $website_cloner->clone($website_clone->url);

        return redirect()->route('website-clone');
    }
}
