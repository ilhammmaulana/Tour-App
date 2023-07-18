<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDestination extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['name'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}
