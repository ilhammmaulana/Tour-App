<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ReviewDestination extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    use HasFactory, useUUID;

    protected $fillable = ['created_by', 'star', 'description', 'destination_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
