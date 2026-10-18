<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\View\View;

class PublicLandingPageController extends Controller
{
    public function show(LandingPage $landingPage): View
    {
        $landingPage->load(['dealer', 'landingPageProducts.product']);

        return view('public.landing.show', compact('landingPage'));
    }
}
