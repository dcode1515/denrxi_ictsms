<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOffice extends Model
{
    use HasFactory;
     protected $table = 'head_office_tbl';
      protected $fillable = [
        'id',
        'head_of_office',
        'created_at',
         'updated_at',

      ];
}
