<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Midtrans Server Key
    |--------------------------------------------------------------------------
    |
    | Server key didapatkan dari dashboard Midtrans.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Client Key
    |--------------------------------------------------------------------------
    |
    | Client key digunakan pada frontend (Snap.js).
    |
    */

    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Production Mode
    |--------------------------------------------------------------------------
    |
    | false = sandbox/testing, true = mode live.
    |
    */

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | Sanitize Input
    |--------------------------------------------------------------------------
    |
    | Membersihkan data input secara otomatis dari karakter tidak valid.
    |
    */

    'is_sanitized' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable 3DS
    |--------------------------------------------------------------------------
    |
    | Aktifkan 3DSecure untuk kartu kredit.
    |
    */

    'is_3ds' => true,
];
