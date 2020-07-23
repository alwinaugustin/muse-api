<?php

namespace Modules\Common\Exceptions;

/**
 * Class RecordNotFoundException
 * @package Modules\Common\Exceptions
 */
class RecordNotFoundException extends StandardizedErrorResponseException
{

    /**
     * Send back a HTTP 400 Bad Request status code
     * @var int
     */
    protected $code = 404;

    /**
     * RecordNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = "Record Not Found")
    {
        parent::__construct($message);
    }
}
