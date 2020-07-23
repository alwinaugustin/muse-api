<?php

namespace Modules\Muse\Transformers;

use League\Fractal;
use Modules\Muse\Transformers\ArtistTransformer;
use Modules\Muse\Transformers\SongTransformer;

/**
 * Class AlbumTransformer
 *
 * @package Modules\Muse\Transformers
 */
class AlbumTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'artists',
        'songs'
    ];
    
    /**
     * Turn this item object into a generic array
     *
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        return [
            'id'               => (int) data_get($item, 'id'),
            'album_name'       => (string) data_get($item, 'album_name'),
            'release_date'     => (string)data_get($item, 'release_date')
        ];
    }

    public function includeArtists($item)
    {
        $artist = $item->artists;

        return !empty($artist)
            ? $this->collection($artist, new ArtistTransformer())
            : $this->null();
    }

    public function includeSongs($item)
    {
        $song = $item->songs;

        return !empty($song)
            ? $this->collection($song, new SongTransformer())
            : $this->null();
    }
}
