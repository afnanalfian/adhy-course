<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard.redirect');
        }

        $request->fulfill();

        // Setelah verifikasi, langsung redirect ke dashboard
        return redirect()->route('dashboard.redirect')
            ->with('verified', 'Akun Anda berhasil diverifikasi!');
    }
}
