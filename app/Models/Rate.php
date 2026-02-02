<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
      protected $table = 'rate_tbl';
    protected $fillable = [
        'id',
        'ticket_id',
        'rate',
        'feedback_remarks',
        'date_feedback',
        'created_at',
        'updated_at',
        'deleted_at',

      ];
      public function ticket()
{
    return $this->belongsTo(Ticket::class, 'ticket_id');
}

}
