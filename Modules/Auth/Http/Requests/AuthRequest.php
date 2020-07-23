<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Modules\Common\Exceptions\AuthenticationFailedException;

class AuthRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'  => 'required',
            'password'  => 'required'
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        throw new AuthenticationFailedException('Authentication Failed', 400, null, $validator->errors());
    }
}
