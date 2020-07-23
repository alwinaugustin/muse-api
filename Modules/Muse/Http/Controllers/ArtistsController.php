<?php

namespace Modules\Muse\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Muse\Entities\Artist;
use Illuminate\Routing\Controller;
use Modules\Muse\Http\Requests\ArtistRequest;
use Modules\Muse\Transformers\ArtistTransformer;

class ArtistsController extends Controller
{
    const NAME = 'Artist(s)';
    
    /**
     * 
     */
    public function get($artistID = null)
    {
        if (!empty($artistID)) {
            $song = Artist::find($artistID);

            return response()->jsend(
                fractal(
                    $song,
                    new ArtistTransformer()
                )->toArray(),
                trans('common::message.view', ['name' => self::NAME])
            );
        }

        $artists = fractal(Artist::all(), new ArtistTransformer())->toArray();

        return response()->jsend(
            $artists,
            trans('common::message.list', ['name' => self::NAME])
        );
    }

    /**
     * @param request $request
     *
     * @return mixed
     */
    public function create(ArtistRequest $request)
    {
        return $this->save($request->all());
    }

    /**
     * @param request $request
     * @param $artistID
     *
     * @return mixed
     */
    public function update(ArtistRequest $request, $artistID)
    {
        return $this->save($request->all(), $artistID);
    }

    /**
     * @param $inputData
     * @param null $artistID
     * @return mixed
     */
    private function save($inputData, $artistID = null)
    {
        $type = !empty($artistID) ? 'update' : 'create';

        $artist = empty($artistID) ? new Artist() : Artist::find($artistID);

        $artist->artist_name = $inputData['artist_name'];

        $artistID = $artist->save();

        return response()->jsend(
            $this->get($artistID),
            trans('common::message.' . $type, ['name' => self::NAME])
        );
    }

    /**
     * @param $artistID
     * @return mixed
     */
    public function delete($artistID)
    {
        $song = Artist::find($artistID);
        $song->delete();

        return response()->jsend(null, trans('common::message.delete', ['name' => self::NAME]), 204);
    }
}
