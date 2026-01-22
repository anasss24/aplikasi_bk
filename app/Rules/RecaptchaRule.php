<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        // Allow dalam development
        if (app()->environment('local', 'testing')) {
            return true;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $value,
        ]);

        $result = $response->json();

        // Untuk development, jika score tidak ada, return true
        if (!isset($result['success'])) {
            return false;
        }

        // reCAPTCHA v2 tidak memiliki score, hanya success
        // reCAPTCHA v3 memiliki score (0.0 - 1.0)
        if (isset($result['score'])) {
            return $result['success'] && $result['score'] > 0.5;
        }

        return $result['success'];
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.';
    }
}
