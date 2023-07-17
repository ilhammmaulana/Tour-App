<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['name', 'address', 'created_by', 'longtitude', 'langtitude'];
    protected $table = 'destinations';
}
