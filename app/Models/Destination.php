<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['name', 'address', 'created_by', 'longitude', 'langtitude', 'image', 'category_id', 'price'];
    protected $table = 'destinations';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public function reviews()
    {
        return $this->hasMany(ReviewDestination::class, 'destination_id');
    }
}
