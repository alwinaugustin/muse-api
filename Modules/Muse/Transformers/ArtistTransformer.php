<?php

namespace Modules\Muse\Transformers;

use League\Fractal;

/**
 * Class ArtistTransformer
 *
 * @package Modules\Muse\Transformers
 */
class ArtistTransformer extends Fractal\TransformerAbstract
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
            'artist_name'       => (string) data_get($item, 'artist_name')
        ];
    }
}
