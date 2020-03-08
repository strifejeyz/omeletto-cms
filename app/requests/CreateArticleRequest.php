<?php namespace App\Requests;

use Kernel\Requests\HTTPRequest;

class CreateArticleRequest extends HTTPRequest
{

    /**
     * Rules to be followed by request
     */
    protected $rules = [
        'title' => 'required|min:10',
        'content' => 'required|min:150'
    ];

}