<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        return match ($request->user()->role) {
            UserRole::SuperAdmin, UserRole::Admin => redirect()->route('admin.dashboard'),
            UserRole::OperationStaff => redirect()->route('operation.dashboard'),
            UserRole::Dealer => redirect()->route('dealer.dashboard'),
        };
    }
}
