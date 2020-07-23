<?php namespace Modules\Common\Exceptions;

class InvalidUserInputException extends StandardizedErrorResponseException
{

    /**
     * Send back a HTTP 400 Bad Request status code
     * @var int
     */
    protected $code = 417;

    /**
     * Error message that will be sent back to the user
     * @var string
     */
    protected $message = 'Input input supplied';
}
