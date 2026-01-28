<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Auth;

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
    $tickets = Ticket::with(['ticketType','ticketCategory','office','headOffice'])
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
        ->where('head_office_id', Auth::user()->head_office_id)
        ->paginate($perPage);
        
    return response()->json([
        'success' => true,
        'data' => $tickets
    ]);
}
}
