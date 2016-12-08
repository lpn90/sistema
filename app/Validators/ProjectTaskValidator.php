<?php

namespace Sistema\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|max:255',
        'status' => 'required|integer',
        'start_date' => 'required|date',
        'due_date' => 'required|date',
   ];
}
