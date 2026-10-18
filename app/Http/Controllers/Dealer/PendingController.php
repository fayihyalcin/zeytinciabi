<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PendingController extends Controller
{
    public function __invoke(): View
    {
        return view('dealer.pending');
    }
}
