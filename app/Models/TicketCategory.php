<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
     use HasFactory;
     use SoftDeletes;
      protected $dates = ['deleted_at'];
     protected $table = 'ticket_category_tbl';
      protected $fillable = [
        'id',
        'ticket_type_id',
        'ticket_category',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

      ];
       public function ticket_type()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }
}
