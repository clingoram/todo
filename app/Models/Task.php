<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    // use HasFactory;

    // 透過特定欄位註記，不是真的直接刪除 row data
    use SoftDeletes;

    // table name
    protected $table = 'task';
    // primary key
    protected $primaryKey = 'id';
    public $incrementing = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id');
    }
}
