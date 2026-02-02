<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator; // Correct import for Laravel Validator
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiveTicketNotif;
use App\Mail\UpdateTicketNotif;
use PDF;


class HelpdeskController extends Controller
{
    //

    public function helpdesk(){
        return view('helpdesk.dashboard');
    }

    public function ticket(){
        return view('helpdesk.ticket');
    }

    public function getDataAllRequest(Request $request){
    // Get the search query and per_page from the request
    $search = $request->query('search');
    $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided

    // Query certifications with optional search
    $tickets = Ticket::with(['ticketType','ticketCategory','office','headOffice','technician'])
        ->when($search, function ($query, $search) {
            return $query
                ->where('helpdesk_no', 'like', '%' . $search . '%')
                ->orWhere('property_number', 'like', '%' . $search . '%')
                ->orWhere('date_created', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('middle_initial', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('position', 'like', '%' . $search . '%')
                
                // ADD THESE 3 LINES FOR CONCATENATED NAME SEARCH
                ->orWhereRaw("CONCAT_WS(' ', firstname, middle_initial, lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(lastname, ', ', firstname) LIKE ?", ['%' . $search . '%'])
                
                ->orWhereHas('ticketType', function ($q) use ($search) {
                    $q->where('ticket_type', 'like', '%' . $search . '%');
                })
                ->orWhereHas('ticketCategory', function ($q) use ($search) {
                    $q->where('ticket_category', 'like', '%' . $search . '%');
                })
                ->orWhereHas('office', function ($q) use ($search) {
                    $q->where('office', 'like', '%' . $search . '%');
                })
                ->orWhereHas('headOffice', function ($q) use ($search) {
                    $q->where('head_of_office', 'like', '%' . $search . '%');
                });
        })
                ->orderBy('created_at','desc')
                 ->whereIn('status', ['Pending', 'In-Progress'])
                ->where('head_office_id', Auth::user()->head_office_id)
                ->paginate($perPage);
                
            return response()->json([
                'success' => true,
                'data' => $tickets
            ]);
}

       public function receive_tickets($id) {
    try {
        // Attempt to find the ticket by ID
        $ticket = Ticket::with(['ticketType','ticketCategory','office','headOffice'])->find($id);

        // Check if ticket is not found
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'error' => 'Ticket not found.'
            ], 404);
        }

        // Check if ticket is already received
        if ($ticket->date_receive) {
            // Get technician details - Assuming technicians are stored in Users table
            $technician = User::find($ticket->receive_technician_id);

            return response()->json([
                'success' => false,
                'error' => 'Ticket Already Assigned',
                'already_assigned' => true,
                'received_by' => $technician 
                    ? $technician->firstname . ' ' . $technician->middle_initial . ' ' . $technician->lastname
                    : 'Unknown Technician',
                'received_at' => $ticket->date_receive,
                'technician_email' => $technician ? $technician->email : null,
                'current_status' => $ticket->status
            ], 409); // 409 Conflict
        }

        // Update the ticket
        $ticket->date_receive = now();
        $ticket->status = 'In-Progress';
        $ticket->receive_technician_id = Auth::id();
        $ticket->save();

        $ticket_request = trim(
            $ticket->firstname . ' ' .
            ($ticket->middle_initial ? $ticket->middle_initial . '. ' : '') .
            $ticket->lastname
        );

         

            if ($ticket && $ticket->email) {
                Mail::to($ticket->email)->send(new ReceiveTicketNotif($ticket, $ticket_request));
            }

        // Get current user info
        $currentUser = Auth::user();

        return response()->json([
            'success' => true,
            'message' => 'Ticket received successfully!',
            'ticket' => $ticket,
            'received_by' => $currentUser->firstname . ' ' . $currentUser->lastname,
            'received_at' => $ticket->date_receive
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
}
public function update_status_tickets(Request $request,$id) {
    try {
         $validator = Validator::make($request->all(), [
            'status' => 'required|in:Resolved,Unresolved',
            'resolution' => 'required',
            
        ], [
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either Resolved or Unresolved.',
            'resolution.required' => 'Resolution notes are required.',
            'resolution.string' => 'Resolution notes must be text.',
            'resolution.max' => 'Resolution notes must not exceed 255 characters.',
            
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        $ticket = Ticket::with(['ticketType','ticketCategory','office','headOffice'])->find($id);

        // Check if ticket is not found
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'error' => 'Ticket not found.'
            ], 404);
        }

        if ($ticket->date_acted) {
            // Get technician details - Assuming technicians are stored in Users table
            $technician = User::find($ticket->receive_technician_id);

            return response()->json([
                'success' => false,
                'error' => 'Ticket Request Already Updated',
                'already_assigned' => true,
                'received_by' => $technician 
                    ? $technician->firstname . ' ' . $technician->middle_initial . ' ' . $technician->lastname
                    : 'Unknown Technician',
                'received_at' => $ticket->date_acted,
                'technician_email' => $technician ? $technician->email : null,
                'current_status' => $ticket->status
            ], 409); // 409 Conflict
        }

       

        // Update the ticket
        $ticket->date_acted = now();
        $ticket->status = $request->status;
         $ticket->resolution = $request->resolution;
      
        $ticket->save();

        $ticket_request = trim(
            $ticket->firstname . ' ' .
            ($ticket->middle_initial ? $ticket->middle_initial . '. ' : '') .
            $ticket->lastname
        );

        if ($ticket && $ticket->email) {
                Mail::to($ticket->email)->send(new UpdateTicketNotif($ticket, $ticket_request));
        }


        // Get current user info
        $currentUser = Auth::user();

        return response()->json([
            'success' => true,
            'message' => 'Ticket Request successfully updated!',
            'ticket' => $ticket,
            'received_by' => $currentUser->firstname . ' ' . $currentUser->lastname,
            'received_at' => $ticket->date_acted
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
}
 public function getDataAllResolvedTicket(Request $request){
    // Get the search query and per_page from the request
    $search = $request->query('search');
    $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided

    // Query certifications with optional search
    $resolveds = Ticket::with(['ticketType','ticketCategory','office','headOffice','technician'])
      ->where('status','Resolved')
                ->where('head_office_id', Auth::user()->head_office_id)
        ->when($search, function ($query, $search) {
            return $query
                ->where('helpdesk_no', 'like', '%' . $search . '%')
                ->orWhere('property_number', 'like', '%' . $search . '%')
                ->orWhere('date_created', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('middle_initial', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('position', 'like', '%' . $search . '%')
                
                // ADD THESE 3 LINES FOR CONCATENATED NAME SEARCH
                ->orWhereRaw("CONCAT_WS(' ', firstname, middle_initial, lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(lastname, ', ', firstname) LIKE ?", ['%' . $search . '%'])
                
                ->orWhereHas('ticketType', function ($q) use ($search) {
                    $q->where('ticket_type', 'like', '%' . $search . '%');
                })
                ->orWhereHas('ticketCategory', function ($q) use ($search) {
                    $q->where('ticket_category', 'like', '%' . $search . '%');
                })
                ->orWhereHas('office', function ($q) use ($search) {
                    $q->where('office', 'like', '%' . $search . '%');
                })
                ->orWhereHas('headOffice', function ($q) use ($search) {
                    $q->where('head_of_office', 'like', '%' . $search . '%');
                });
        })
                ->orderBy('created_at','desc')
                ->paginate($perPage);
                
            return response()->json([
                'success' => true,
                'data' => $resolveds
            ]);
}

public function getDataAllUnResolvedTicket(Request $request){
    // Get the search query and per_page from the request
    $search = $request->query('search');
    $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided

    // Query certifications with optional search
    $unresolveds = Ticket::with(['ticketType','ticketCategory','office','headOffice','technician'])
     ->where('status','=','UnResolved')
    ->where('head_office_id', Auth::user()->head_office_id)
        ->when($search, function ($query, $search) {
            return $query
                ->where('helpdesk_no', 'like', '%' . $search . '%')
                ->orWhere('property_number', 'like', '%' . $search . '%')
                ->orWhere('date_created', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('middle_initial', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('position', 'like', '%' . $search . '%')
                
                // ADD THESE 3 LINES FOR CONCATENATED NAME SEARCH
                ->orWhereRaw("CONCAT_WS(' ', firstname, middle_initial, lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(lastname, ', ', firstname) LIKE ?", ['%' . $search . '%'])
                
                ->orWhereHas('ticketType', function ($q) use ($search) {
                    $q->where('ticket_type', 'like', '%' . $search . '%');
                })
                ->orWhereHas('ticketCategory', function ($q) use ($search) {
                    $q->where('ticket_category', 'like', '%' . $search . '%');
                })
                ->orWhereHas('office', function ($q) use ($search) {
                    $q->where('office', 'like', '%' . $search . '%');
                })
                ->orWhereHas('headOffice', function ($q) use ($search) {
                    $q->where('head_of_office', 'like', '%' . $search . '%');
                })
                ->orWhereHas('technician', function ($q) use ($search) {
                    $q
                    ->OrWhere('firstname', 'like', '%' . $search . '%')
                      ->OrWhere('middle_initial', 'like', '%' . $search . '%')
                        ->OrWhere('lastname', 'like', '%' . $search . '%');
                });
        })
                ->orderBy('created_at','desc')   
                ->paginate($perPage);
                
            return response()->json([
                'success' => true,
                'data' => $unresolveds
            ]);
}
    public function print_forms($id){

      // Validate that $id is numeric
            if (!is_numeric($id)) {
                return abort(400, 'Invalid ticket ID.');
            }

            // Attempt to find ticket with relationships
            $ticket = Ticket::with(['ticketType', 'ticketCategory', 'technician', 'office'])->find($id);

            // If ticket not found, abort with 404
            if (!$ticket) {
                return abort(404, 'Ticket not found.');
            }

            // Generate PDF using folio size
            $pdf = PDF::loadView('helpdesk.print_form', compact('ticket'))
                    ->setPaper([0, 0, 612, 936], 'portrait'); // Folio: 8.5 x 13 inch

            // Stream PDF to browser
            return $pdf->stream('ticket_' . $ticket->helpdesk_no . '.pdf');
        
    }

    public function getDataAllFeedback(Request $request){
    // Get the search query and per_page from the request
    $search = $request->query('search');
    $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided

    // Query certifications with optional search
    $feedbacks = Ticket::with(['ticketType','ticketCategory','office','headOffice','technician','rate'])
   ->whereIn('status', ['UnResolved', 'Resolved'])

    ->where('head_office_id', Auth::user()->head_office_id)
        ->when($search, function ($query, $search) {
            return $query
                ->where('helpdesk_no', 'like', '%' . $search . '%')
                ->orWhere('property_number', 'like', '%' . $search . '%')
                ->orWhere('date_created', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('middle_initial', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('position', 'like', '%' . $search . '%')
                
                // ADD THESE 3 LINES FOR CONCATENATED NAME SEARCH
                ->orWhereRaw("CONCAT_WS(' ', firstname, middle_initial, lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(lastname, ', ', firstname) LIKE ?", ['%' . $search . '%'])
                
                ->orWhereHas('ticketType', function ($q) use ($search) {
                    $q->where('ticket_type', 'like', '%' . $search . '%');
                })
                ->orWhereHas('ticketCategory', function ($q) use ($search) {
                    $q->where('ticket_category', 'like', '%' . $search . '%');
                })
                ->orWhereHas('office', function ($q) use ($search) {
                    $q->where('office', 'like', '%' . $search . '%');
                })
                ->orWhereHas('headOffice', function ($q) use ($search) {
                    $q->where('head_of_office', 'like', '%' . $search . '%');
                })
                ->orWhereHas('technician', function ($q) use ($search) {
                    $q
                    ->OrWhere('firstname', 'like', '%' . $search . '%')
                      ->OrWhere('middle_initial', 'like', '%' . $search . '%')
                        ->OrWhere('lastname', 'like', '%' . $search . '%');
                });
        })
                ->orderBy('created_at','desc')   
                ->paginate($perPage);
                
            return response()->json([
                'success' => true,
                'data' => $feedbacks
            ]);
}

  

}
