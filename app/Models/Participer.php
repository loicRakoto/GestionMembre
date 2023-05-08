<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participer extends Model
{
    use HasFactory;

    public function membress()
    {
        return $this->belongsTo(Membre::class, 'membre_id');
    }
}
