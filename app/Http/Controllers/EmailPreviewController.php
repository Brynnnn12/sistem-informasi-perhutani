<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;

class EmailPreviewController extends Controller
{
    public function resetPassword()
    {
        // Sample data for preview
        $sampleMail = new ResetPasswordMail(
            token: 'sample-token-for-preview-only',
            email: 'user@example.com',
            name: 'John Doe'
        );

        return $sampleMail;
    }
}
