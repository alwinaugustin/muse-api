<?php

namespace Modules\Muse\Transformers;

use League\Fractal;

/**
 * Class SongTransformer
 *
 * @package Modules\Muse\Transformers
 */
class SongTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        return [
            'id'                => (int) data_get($item, 'id'),
            'song_name'         => (string) data_get($item, 'song_name'),
            'song_duration'     => (float)data_get($item, 'song_duration')

        ];
    }
}
