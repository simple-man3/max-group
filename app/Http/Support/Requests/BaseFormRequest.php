<?php

namespace App\Http\Support\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
