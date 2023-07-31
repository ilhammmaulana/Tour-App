<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory, useUUID;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function destinations()
    {
        return $this->hasMany(Destination::class, 'province_id');
    }
}
