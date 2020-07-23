<?php

namespace Modules\Common\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Modules\Common\Exceptions\InvalidUserInputException;

/**
 * Class Request
 *
 * @package Modules\Common\Requests\V1
 */
abstract class Request extends FormRequest
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


    /*  Filters to be applied to the input.
    *
    *  @return void
    */
    public function filters()
    {
        return [];
    }

    /**
     * Validate the input.
     *
     * @param  \Illuminate\Validation\Factory $factory
     * @return \Illuminate\Validation\Validator
     */
    public function validator($factory)
    {
        $validator =  $factory->make(
            $this->sanitizeInput(),
            $this->container->call([$this, 'rules']),
            $this->messages()
        );

        if (method_exists($this, 'customValidation')) {
            $this->customValidation($validator);
        }

        return $validator;
    }

    /**
     * Sanitize the input.
     *
     * @return array
     */
    protected function sanitizeInput()
    {
        if (method_exists($this, 'sanitize')) {
            return $this->container->call([$this, 'sanitize']);
        }

        return $this->all();
    }

    /**
     * @param Validator $validator
     * @throws InvalidUserInputException
     * @return null
     */
    protected function failedValidation(Validator $validator)
    {
        throw new InvalidUserInputException(trans('common::message.invalid_input'), 400, null, $validator->errors());
    }
}
