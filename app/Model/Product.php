<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'alias', 'cat_id', 'brand_id', 'short_text', 'description', 'currency', 'price', 'status', 'special_deals', 'flash_sale', 'top_sales', 'most_liked', 'just_for_you', 'seo', 'quantity' , 'custom', 'discount', 'net_price', 'discount_type', 'emi_description', 'emi', 'downpayment'
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

    public function images(){
        return $this->hasMany('App\Model\ProductImage','product_id','id');
    }

    public function status(){
        if ($this->status == 1) {
            return '<button class="btn btn-success btn-xs">Pubish</button>';
        }elseif ($this->status == 2) {
            return '<button class="btn btn-primary btn-xs">Unpublish</button>';
        }
    }

    public function emi(){
        if ($this->emi == 1) {
            return '<button class="btn btn-success btn-xs">Yes</button>';
        }elseif ($this->emi == 0) {
            return '<button class="btn btn-primary btn-xs">No</button>';
        }
    }

    public function flashSale(){
        if ($this->flash_sale == 1) {
            return '<button class="btn btn-success btn-xs">Yes</button>';
        }elseif ($this->flash_sale == 0) {
            return '<button class="btn btn-primary btn-xs">No</button>';
        }
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function tags(){
        return $this->hasMany(Tag::class,'product_id','id');
    }
}
