<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // if set up this function then default primary key would not be id but slug
    // public function getRouteKeyName() {
    //     return "slug";
    // }
}
