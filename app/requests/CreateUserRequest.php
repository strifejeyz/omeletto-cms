<?php namespace App\Requests;

use Kernel\Requests\HTTPRequest;

class CreateUserRequest extends HTTPRequest
{

    /**
     * Rules to be followed by request
     */
    protected $rules = [
        'firstname' => 'name:First Name|required',
        'lastname'  => 'name:Last Name|required',
        'email'     => 'name:E-mail|required|min:8|email|unique:users',
        'role'      => 'name:Role|required',
        'username'  => 'name:Username|required|min:8|unique:users',
        'password'  => 'name:Password|required|min:8|match:confirm_password',
        'confirm_password' => 'name:Confirm Password|required',
    ];

}