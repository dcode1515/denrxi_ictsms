<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadOffice extends Model
{
    use HasFactory;
     use SoftDeletes;
      protected $dates = ['deleted_at'];
     protected $table = 'head_office_tbl';
      protected $fillable = [
        'id',
        'head_of_office',
        'created_at',
         'updated_at',
         'deleted_at',

      ];
}
