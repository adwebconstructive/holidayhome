<?php

return [
    'creation_validation_rules' => [
        'hotel_id' => 'required|string',
        'room_id' => 'required|integer',
        'from' => 'required|string',
        'to' => 'required|string',
    ],
];
