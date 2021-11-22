<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Settings for provider Canal (smscanal.com)
    |--------------------------------------------------------------------------
    | 
    | Here we define the credentials given to us by the provider
    | Note: Keep in mind that you can use the respective env keys in capitals in your .env file
    |
    */
    
    'canal_api_url' => env('BEAK_CANAL_API_URL', 'http://messaging.smscanal.com/sms'),
    'canal_api_user' => env('BEAK_CANAL_API_USER', ''),
    'canal_api_password' => env('BEAK_CANAL_API_PASSWORD', ''),
    'canal_api_sender' => env('BEAK_CANAL_API_SENDER', ''),    

];
