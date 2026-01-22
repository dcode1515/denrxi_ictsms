<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory;
     use SoftDeletes;
      protected $dates = ['deleted_at'];
     protected $table = 'office_tbl';
      protected $fillable = [
        'id',
        'head_office_id',
        'office',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

      ];
       public function office_under()
    {
        return $this->belongsTo(HeadOffice::class, 'head_office_id');
    }
    
}
