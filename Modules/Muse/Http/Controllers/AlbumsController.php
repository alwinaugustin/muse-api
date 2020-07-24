<?php

namespace Modules\Muse\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Modules\Muse\Entities\Album;
use Illuminate\Routing\Controller;
use Modules\Muse\Http\Requests\AlbumRequest;
use Modules\Muse\Transformers\AlbumTransformer;

class AlbumsController extends Controller
{
    const NAME = 'Album(s)';
    
    /**
     * 
     */
    public function get($albumID = null)
    {
        if (!empty($albumID)) {
            $album = Album::find($albumID);

            return response()->jsend(
                fractal(
                    $album,
                    new AlbumTransformer()
                )->toArray(),
                trans('common::message.view', ['name' => self::NAME])
            );
        }

        $albums = fractal(Album::with(['songs', 'artists'])->get(), new AlbumTransformer())->toArray();

        return response()->jsend(
            $albums,
            trans('common::message.list', ['name' => self::NAME])
        );
    }

    /**
     * @param request $request
     *
     * @return mixed
     */
    public function create(AlbumRequest $request)
    {
        return $this->save($request->all());
    }

    /**
     * @param request $request
     * @param $albumID
     *
     * @return mixed
     */
    public function update(AlbumRequest $request, $albumID)
    {
        return $this->save($request->all(), $albumID);
    }

    /**
     * @param $inputData
     * @param null $albumID
     * @return mixed
     */
    private function save($inputData, $albumID = null)
    {
        $type = !empty($albumID) ? 'update' : 'create';

        $album = empty($albumID) ? new Album() : Album::find($albumID);

        $album->album_name      = $inputData['album_name'];
        $album->release_date    = Carbon::parse($inputData['release_date'])->toDate();

        $albumID = $album->save();

        $album->songs()->sync($inputData['songs']);
        
        $album->artists()->sync($inputData['artists']);

        return response()->jsend(
            $this->get($albumID),
            trans('common::message.' . $type, ['name' => self::NAME])
        );
    }

    /**
     * @param $albumID
     * @return mixed
     */
    public function delete($albumID)
    {
        $album = Album::find($albumID);
        $album->songs()->delete();
        $album->artists()->delete();
        $album->delete();

        return response()->jsend(null, trans('common::message.delete', ['name' => self::NAME]), 204);
    }
}
