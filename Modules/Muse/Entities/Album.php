<?php

namespace Modules\Muse\Entities;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [];
    public $timestamps  = false;

    public function songs()
    {
        return $this->belongsToMany('Modules\Muse\Entities\Song', 'album_songs');
    }

    public function artists()
    {
        return $this->belongsToMany('Modules\Muse\Entities\Artist', 'album_artists');
    }
}
