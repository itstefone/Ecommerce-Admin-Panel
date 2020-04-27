<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{
    

    protected $fillable = ['key', 'value'];


    public function get(string $key) {

        $setting = new self();

        $entry = $setting->where('key', $key)->first();

        if(!$entry) return;

        return $entry->value;



    }


    public function set($key, $value) {


        $setting = new self();


        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;

        $entry->saveOrFail();

        Config::set('key', $value);


        if(Config::get($key) == $value) {
            return true;
        }

        return false;
    }
}
