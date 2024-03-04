<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable =['name','image'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    use HasFactory;
}
