<?php

namespace Modules\Muse\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Muse\Entities\Song;
use Illuminate\Routing\Controller;
use Modules\Muse\Http\Requests\V1\SongRequest;
use Modules\Muse\Transformers\SongTransformer;

class SongsController extends Controller
{
    const NAME = 'Song(s)';
    
    /**
     * 
     */
    public function get($songID = null)
    {
        if (!empty($songID)) {
            $song = Song::find($songID);

            return response()->jsend(
                fractal(
                    $song,
                    new SongTransformer()
                )->toArray(),
                trans('common::message.view', ['name' => self::NAME])
            );
        }

        $songs = fractal(Song::all(), new SongTransformer())->toArray();

        return response()->jsend(
            $songs,
            trans('common::message.list', ['name' => self::NAME])
        );
    }

    /**
     * @param request $request
     *
     * @return mixed
     */
    public function create(SongRequest $request)
    {
        return $this->save($request->all());
    }

    /**
     * @param request $request
     * @param $songID
     *
     * @return mixed
     */
    public function update(SongRequest $request, $songID)
    {
        return $this->save($request->all(), $songID);
    }

    /**
     * @param $inputData
     * @param null $songID
     * @return mixed
     */
    private function save($inputData, $songID = null)
    {
        $type = !empty($songID) ? 'update' : 'create';

        $song = empty($songID) ? new Song() : Song::find($songID);

        $song->song_name        = $inputData['song_name'];
        $song->song_duration    = $inputData['song_duration'];

        $songID = $song->save();

        return response()->jsend(
            $this->get($songID),
            trans('common::message.' . $type, ['name' => self::NAME])
        );
    }

    /**
     * @param $songID
     * @return mixed
     */
    public function delete($songID)
    {
        $song = Song::find($songID);
        $song->delete();

        return response()->jsend(null, trans('common::message.delete', ['name' => self::NAME]), 204);
    }
}
