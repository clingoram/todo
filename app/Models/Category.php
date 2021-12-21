<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'category';
  protected $primaryKey = 'id';
  public $incrementing = true;

  public $fillable = [
    'name',
    'created_at'
  ];
  protected $guarded = ['id'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];
}
