<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // use MultiTenantModelTrait;
    protected $fillable = ['title', 'text', 'author'];
    public function user(){
        return $this->belongsTo(User::class);

    }
}
