<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\TicketCategory;
use App\Models\HeadOffice;
use App\Models\Office;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Carbon\Carbon;


class TicketController extends Controller
{
    //

    public function ticket(){
        return view('ticket.ticket');
    }
     public function ticket_status(){
        return view('ticket.ticket_status');
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
     public function store_ticket(Request $request)
{
    try {

        $validated = $request->validate([
            'ticket_type'      => 'required',
            'ticket_category'  => 'required',
            'property_number'  => 'nullable',
            'firstname'        => 'required',
            'middle_initial'   => 'nullable',
            'lastname'         => 'required',
            'extension'        => 'nullable',
            'email'            => 'required|email|max:150',
            'position'         => 'required|string|max:150',
            'head_office'      => 'required',
            'office'           => 'required',
            'concern'          => 'required',
        ]);

        $ticket = new Ticket();
        $ticket->ticket_type_id     = $request->ticket_type;
        $ticket->ticket_category_id = $request->ticket_category;
        $ticket->property_number    = $request->property_number;
        $ticket->date_created       = now();
        $ticket->firstname          = $request->firstname;
        $ticket->middle_initial     = $request->middle_initial;
        $ticket->lastname           = $request->lastname;
        $ticket->extension          = $request->extension;
        $ticket->email              = $request->email;
        $ticket->position           = $request->position;
        $ticket->head_office_id     = $request->head_office;
        $ticket->office_id          = $request->office;
        $ticket->issue_concern      = $request->concern;
        $ticket->agree_terms      = $request->agree_terms;
        $ticket->token = Str::random(64);
        $ticket->status             = 'Pending';

        // Generate Helpdesk Number
        $ticket->helpdesk_no = Ticket::generateHelpdeskNo(
            $request->firstname,
            $request->middle_initial,
            $request->lastname
        );

        if ($request->hasFile('attachment')) {
                            $file = $request->file('attachment');
                            $ext = $file->extension();
                            $now = Carbon::now();
                            $name = str_replace(' ', '_', strtoupper($ticket->firstname . '_' . $ticket->middle_initial . '_' . $ticket->lastname));
                            $contact = $ticket->helpdesk_no;
                            $fileName = $now->year . '-' . $name . '-' . $contact . '.' . $ext;

                            // Ensure the directory exists
                            $directory = public_path('attachment/ticket/' . $ticket->helpdesk_no);
                            if (!file_exists($directory)) {
                                mkdir($directory, 0777, true);
                            }

                            // Delete old photo if exists
                            if ($ticket->attachment && file_exists($directory . '/' . $ticket->attachment)) {
                                unlink($directory . '/' . $ticket->attachment);
                            }

                            // Move the file to the desired location
                            $file->move($directory, $fileName);
                            $ticket->attachment = $fileName;
                        }

        
        $ticket->save();

        return response()->json([
            'status'  => true,
            'message' => 'Ticket created successfully', 
            'ticketID' => $ticket->token,       
            'data'    => $ticket
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {

        return response()->json([
            'status'  => false,
            'message' => 'Validation failed',
            'errors'  => $e->errors()
        ], 422);

    } catch (\Exception $e) {

        return response()->json([
            'status'  => false,
            'message' => 'Failed to create ticket',
            'error'   => $e->getMessage()
        ], 500);
    }
}

    public function ticket_success($token)
        {
            $ticket = Ticket::where('token', $token)->firstOrFail();

            return view('ticket.success', ['ticket' => $ticket]);
        }

}
