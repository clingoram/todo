<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;
  protected $table = 'category';
  protected $primaryKey = 'id';
  public $incrementing = true;

  public $fillable = [
    'name'
  ];
  protected $guarded = ['id'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  // protected $dates = ['deleted_at'];
}
