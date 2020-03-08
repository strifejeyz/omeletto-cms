<?php namespace App\Requests;

use Kernel\Requests\HTTPRequest;

class EditUserRequest extends HTTPRequest
{
    /**
     * Rules to be followed by request
     */
    protected $rules = [
        'firstname' => 'name:First Name|required',
        'lastname'  => 'name:Last Name|required',
        'email'     => 'name:E-mail|required|min:8|email',
        'username'  => 'name:Username|required|min:8',
    ];
}