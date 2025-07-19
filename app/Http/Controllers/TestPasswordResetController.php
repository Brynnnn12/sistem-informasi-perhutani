<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class TestPasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak valid atau tidak terdaftar.',
                'errors' => $validator->errors()
            ], 422);
        }

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Link reset password telah dikirim ke email Anda.',
                'status' => $status
            ]);
        }

        $message = match ($status) {
            Password::RESET_THROTTLED => 'Silakan tunggu sebelum mencoba lagi. Anda sudah mengirim permintaan reset password baru-baru ini.',
            Password::INVALID_USER => 'Email tidak terdaftar dalam sistem.',
            default => 'Terjadi kesalahan saat mengirim email reset password.'
        };

        return response()->json([
            'success' => false,
            'message' => $message,
            'status' => $status
        ], 429);
    }

    public function testForm()
    {
        return view('test.password-reset-form');
    }
}
