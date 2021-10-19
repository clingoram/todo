<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // use HasFactory;
    protected $table = 'task';
    protected $primaryKey = 'id';
    public $incrementing = true;


    public function category()
    {
        return $this->hasOne(Category::class, 'id');
    }
}
