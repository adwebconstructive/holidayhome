<?php

return [
    'creation_validation_rules' => [
        'emp_id' => ['required', 'string', 'max:255','unique:users'],
        'name' => ['required', 'string', 'max:255'],
        'phone_number' => ['required','unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6'],
    ],

    'update_validation_rules' => [
        'emp_id' => ['required', 'string', 'max:255'],
        'name' => ['required', 'string', 'max:255'],
        'phone_number' => ['required'],
        'email' => ['required', 'string', 'email', 'max:255'],
    ],
];
