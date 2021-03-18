<?php

return [
    'creation_validation_rules' => [
        'name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'state' => 'required',
        'country' => 'required',
        'pin_code' => 'required|integer',
        'contact_person' => 'required',
        'contact_email' => 'required|email',
        'contact_phone' => 'required|min:10|string'
    ],

    'update_validation_rules' =>  [
        'name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'state' => 'required',
        'country' => 'required',
        'pin_code' => 'required|integer',
        'contact_person' => 'required',
        'contact_email' => 'required|email',
        'contact_phone' => 'required|min:10|string'
    ],
];
