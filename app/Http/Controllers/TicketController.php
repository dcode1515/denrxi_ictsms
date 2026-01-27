<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\TicketCategory;
use App\Models\HeadOffice;
use App\Models\Office;

class TicketController extends Controller
{
    //

    public function ticket(){
        return view('ticket.ticket');
    }
    public function TicketType()
    {
        $tickettypes = TicketType::orderBy('created_at', 'asc')
            ->select('id', 'ticket_type')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $tickettypes
        ], 200);
    }

     public function categoriesByTicketType($tickettypeID)
    {
        $categories = TicketCategory::where('ticket_type_id', $tickettypeID)
            ->orderBy('ticket_category', 'asc')
            ->select('id', 'ticket_category', 'ticket_type_id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $categories
        ], 200);
    }

    public function headOffices()
    {
        $headOffices = HeadOffice::orderBy('created_at', 'asc')
            ->select('id', 'head_of_office')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $headOffices
        ], 200);
    }

     public function officesByHeadOffice($headOfficeId)
    {
        $offices = Office::where('head_office_id', $headOfficeId)
            ->orderBy('office', 'asc')
            ->select('id', 'office', 'head_office_id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $offices
        ], 200);
    }
}
