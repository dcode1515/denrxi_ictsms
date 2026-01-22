<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'ticket_type_tbl';
    protected $fillable = [
        'id',
        'ticket_type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

      ];
}
