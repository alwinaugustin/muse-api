<?php namespace Modules\Common\Exceptions;

class AuthenticationFailedException extends StandardizedErrorResponseException
{

    /**
     * Send back a HTTP 400 Bad Request status code
     * @var int
     */
    protected $code = 400;

    /**
     * Error message that will be sent back to the user
     * @var string
     */
    protected $message = 'Invalid login details provided.';
}
