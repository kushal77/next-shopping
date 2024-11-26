<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
	use Sluggable;

    protected $fillable = ['title', 'alias', 'description'];

    public function sluggable()
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }
}
