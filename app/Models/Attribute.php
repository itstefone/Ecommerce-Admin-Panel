<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'code', 'name', 'frontend_type', 'is_filterable', 'is_required'
    ];
    protected $casts = [
        'is_required' => 'boolean',
        'is_filterable' => 'boolean'
    ];
    public function values() {
        return $this->hasMany(AttributeValue::class);
    }
}
