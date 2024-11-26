<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question', 'answer', 'status'
    ];

    public function status(){
        if ($this->status == 1) {
            return '<button class="btn btn-success btn-xs">Pubish</button>';
        }elseif ($this->status == 2) {
            return '<button class="btn btn-primary btn-xs">Unpublish</button>';
        }
    }
}
