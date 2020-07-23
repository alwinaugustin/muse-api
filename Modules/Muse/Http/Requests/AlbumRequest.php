<?php

namespace Modules\Muse\Http\Requests;

use Modules\Common\Requests\V1\Request;

/**
 * Class AlbumRequest
 *
 * @package Modules\Muse\Http\Requests
 */
class AlbumRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'album_name'       => 'required|string',
            'release_date'     => 'required|date',
            'songs'            => 'required|array',
            'songs.*'          => 'integer|exists:songs,id',
            'artists'          => 'required|array',
            'artists.*'        => 'integer|exists:artists,id'
        ];
    }
}
