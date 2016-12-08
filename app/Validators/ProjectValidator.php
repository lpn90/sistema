<?php
/**
 * User: Leonardo
 * Date: 17/11/2016
 * Time: 16:48
 */

namespace Sistema\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:255',
        'description' => 'max:255',
        'status' => 'required|integer|between:1,5',
        'progress' => 'required|integer|between:0,100',
        'due_date' => 'required|date',
    ];

}