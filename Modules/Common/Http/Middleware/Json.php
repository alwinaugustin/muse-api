<?php

namespace Modules\Common\Http\Middleware;

use Closure;
use Modules\Common\Exceptions\InvalidContentTypeException;

class Json
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws InvalidContentTypeException
     */
    public function handle($request, Closure $next)
    {
        if (! $request->isJson()) {
            throw new InvalidContentTypeException();
        }

        if (! $this->validJson($request->getContent())) {
            throw new InvalidContentTypeException('Invalid Request Body', 415);
        }

        return $next($request);
    }

    /**
     * Checks if the passed value is a valid json
     *
     * @param $json
     * @return bool
     */
    private function validJson($json)
    {
        if (is_array(json_decode($json, true)) && json_last_error() == JSON_ERROR_NONE) {
            return true;
        }

        return false;
    }
}
