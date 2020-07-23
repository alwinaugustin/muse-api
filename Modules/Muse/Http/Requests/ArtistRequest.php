<?php

namespace Modules\Muse\Http\Requests;

use Modules\Common\Requests\V1\Request;

/**
 * Class ArtistRequest
 *
 * @package Modules\Muse\Http\Requests
 */
class ArtistRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'artist_name' => 'required|string'
        ];
    }
}
