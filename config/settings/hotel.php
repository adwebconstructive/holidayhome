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
        'contact_phone' => 'required|min:10|string',
    ],

    'update_validation_rules' => [
        'name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'state' => 'required',
        'country' => 'required',
        'pin_code' => 'required|integer',
        'contact_person' => 'required',
        'contact_email' => 'required|email',
        'contact_phone' => 'required|min:10|string',
    ],

    'room_creation_validation_rules' => [
        'room_number' => 'required|string',
        'description' => 'required|string',
        'room_type' => 'required|string',
        'person_allowed' => 'required|integer',
        'max_person_allowed' => 'required|integer',
        'rate' => 'required|integer',
        'price' => 'required|integer',
    ],

    'image_upload_validation_rules' => [
        'hotel_id' => 'required',
        'images' => 'required'
    ]
];
