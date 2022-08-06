<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

abstract class BasicRequest extends FormRequest
{
    use ApiResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract public function rules();
}
