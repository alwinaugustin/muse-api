<?php

namespace Modules\Muse\Http\Requests\V1;

use Modules\Common\Requests\V1\Request;

/**
 * Class SongRequest
 *
 * @package Modules\Muse\Http\Requests
 */
class SongRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'song_name'         => 'required|string',
            'song_duration'     => 'required'
        ];
    }
}
