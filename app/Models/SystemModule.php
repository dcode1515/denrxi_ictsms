<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemModule extends Model
{
  use HasFactory;
     use SoftDeletes;
      protected $dates = ['deleted_at'];
     protected $table = 'module_assign';
      protected $fillable = [
        'id',
        'module_assign',
        'created_at',
        'updated_at',
        'deleted_at',

      ];
}
