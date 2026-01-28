<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
   use HasFactory;
     use SoftDeletes;
      protected $dates = ['deleted_at'];
     protected $table = 'ticket_tbl';
      protected $fillable = [
        'id',
        'ticket_type_id',
        'ticket_category_id',
        'property_number',
        'helpdesk_no',
        'date_created',
        'firstname',
        'middle_initial',
        'lastname',
        'extension',
        'email',
        'position',
        'head_office_id',
        'office_id',
        'issue_concern',
        'attachment',
        'token',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

      ];
      public static function generateHelpdeskNo($firstname, $middleInitial, $lastname)
    {
        $initials =
            strtoupper(substr($firstname, 0, 1)) .
            strtoupper(substr($middleInitial ?? '', 0, 1)) .
            strtoupper(substr($lastname, 0, 1));

        $lastTicket = self::withTrashed()->latest('id')->first();
        $nextNumber = $lastTicket ? $lastTicket->id + 1 : 1;

        $sequence = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        return "DENRXI-ICT-{$initials}-{$sequence}";
    }

       public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }
    public function ticketCategory()
    {
        return $this->belongsTo(ticketCategory::class, 'ticket_category_id');
    }
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
    public function headOffice()
    {
        return $this->belongsTo(HeadOffice::class, 'head_office_id');
    }
      
}
