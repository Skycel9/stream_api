<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = array("name", "slug", "description", "color");

    public function video() {
        return $this->hasMany(Video::class);
    }
}
