<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $fillable = ['code', 'label', 'value', 'status'];

    public static function getSettingByCode($code){
        $data = self::where('status',1)->where('code',$code)->pluck('value')->first();
        return $data;
    }
}
