<?php


if (!function_exists('formatErrorValidation')) {
    function formatErrorValidatioon($errors)
    {
        $formattedErrors = [];
        foreach ($errors->toArray() as $field => $messages) {
            foreach ($messages as $message) {
                $formattedErrors[] = [
                    'param' => $field,
                    'message' => $message
                ];
            }
        }
        return $formattedErrors;
    }
}
if (!function_exists('generateOTP')) {
    function generateOTP()
    {
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return $otp;
    }
}
