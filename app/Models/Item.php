<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
