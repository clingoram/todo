<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    // table name
    protected $table = 'task';
    // primary key
    protected $primaryKey = 'id';
    public $incrementing = true;

    /**
     * 白名單可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'created_at',
        'status',
        'end_at',
        'classification'
    ];
    // 黑名單(無法修改)
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
