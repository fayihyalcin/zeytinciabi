<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DealerRegistrationRequest;
use App\Models\User;
use App\Services\AdminRegistrationNotificationMailService;
use App\Services\DealerRegistrationService;
use App\Services\UserWelcomeMailService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(
        DealerRegistrationRequest $request,
        DealerRegistrationService $registrationService,
        UserWelcomeMailService $welcomeMailService,
        AdminRegistrationNotificationMailService $adminRegistrationMailService
    ): RedirectResponse {
        $user = $registrationService->register($request->validated());

        event(new Registered($user));
        $welcomeMailService->send($user);
        $adminRegistrationMailService->sendNewDealer($user, 'form');

        Auth::login($user);

        return redirect()->route('dealer.pending')->with('status', 'Bayi başvurunuz alındı. Onay sonrası paneliniz açılacak.');
    }
}
