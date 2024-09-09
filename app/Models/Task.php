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

    // this is for security reason. We need to set up to not overwritten for example password or sensitive data with mass assigment
    protected $fillable = [
        'title',
        'description',
        'long_description'
    ];

    // you can set wich one are guarded but if you do it then every new field will be by default fillable.
    // so it is better to just use fillable wothout guarded
    // protected $guarded = ['id','created_at','updated_at'];
}
