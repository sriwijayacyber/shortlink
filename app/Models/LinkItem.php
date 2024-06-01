<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkItem extends Model
{
    use HasFactory;

    public function link(){
        return $this->belongsTo(Link::class);
    }
}
