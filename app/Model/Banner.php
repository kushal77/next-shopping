<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Banner extends Model
{
	use Sluggable;

    protected $fillable = [
        'title', 'alias', 'image', 'status'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function status(){
        if ($this->status == 1) {
            return '<button class="btn btn-success btn-xs">Pubish</button>';
        }elseif ($this->status == 2) {
            return '<button class="btn btn-primary btn-xs">Unpublish</button>';
        }
    }
}
