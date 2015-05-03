<?php namespace Pingpong\Admin\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Validator extends FormRequest
{

    /**
     * Authorize.
     *
     * @return boolean
     */
    public function authorize()
    {
        return Auth::check();
    }
}
