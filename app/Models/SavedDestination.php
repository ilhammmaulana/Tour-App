<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedDestination extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['destination_id', 'created_by'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
