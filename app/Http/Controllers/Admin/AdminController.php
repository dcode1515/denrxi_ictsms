<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadOffice;
use App\Models\Office;
use App\Models\TicketType;
use App\Models\TicketCategory;
use App\Models\User;
use App\Models\SystemModule;
use Illuminate\Support\Facades\Validator; // Correct import for Laravel Validator

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function head_office ()
    {
        return view('admin.head_office ');
    }
    public function store_office_head(Request $request){
        $validator = Validator::make($request->all(), [
            'head_of_office' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        if (HeadOffice::where('head_of_office', $request->head_of_office)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'The Office Head already exists.'
            ], 409); // 409 Conflict status code
        }
    
        try {
            $office = new HeadOffice;
            $office->head_of_office = $request->head_of_office;
            $office->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Office Heads created successfully',
                'data' => $office
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }
     public function get_data_office_head(Request $request){
           // Get the search query and per_page from the request
           $search = $request->query('search');
           $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided
       
           // Query certifications with optional search
           $offices = HeadOffice::when($search, function ($query, $search) {
               return $query->where('head_of_office', 'like', '%' . $search . '%');
                           
           })
           ->paginate($perPage);
       
           return response()->json([
               'success' => true,
               'data' => $offices
           ]);

    }
    public function update_office_head(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'head_of_office' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
       
        try {
            $office =  HeadOffice::find($id);
            $office->head_of_office = $request->head_of_office;
            $office->status = $request->status;
            $office->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Office Heads Updated successfully',
                'data' => $office
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_office_head(Request $request, $id)
    {
        try {
            $office = HeadOffice::find($id);
            
            if (!$office) {
                return response()->json([
                    'success' => false,
                    'message' => 'Office Head not found'
                ], 404);
            }
            
            $office->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Office Head deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function delete_office(Request $request, $id)
    {
        try {
            $office = Office::find($id);
            
            if (!$office) {
                return response()->json([
                    'success' => false,
                    'message' => 'Office Head not found'
                ], 404);
            }
            
            $office->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Office  deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function office ()
    {
        return view('admin.office');
    }
      public function getOfficeHead()
    {
        $officeheads = HeadOffice::orderBy('head_of_office', 'asc')->get();
        return response()->json($officeheads);
        
    }
     public function getTicketType()
    {
        $tickettypes = TicketType::orderBy('ticket_type', 'asc')->get();
        return response()->json($tickettypes);
        
    }
    public function store_office(Request $request){
        $validator = Validator::make($request->all(), [
            'head_of_office' => 'required',
            'office' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        if (Office::where('head_office_id', $request->head_of_office)
        ->where('office', $request->office)
        ->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'The office already exists under the selected office.',
            ], 409); // 409 Conflict status code
            }
    
        try {
            $office = new Office;
            $office->head_office_id = $request->head_of_office;
            $office->office = $request->office;
            $office->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Office created successfully',
                'data' => $office
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }

    }
    public function getDataOffice(Request $request){
         // Get the search query and per_page from the request
           // Get the search query and per_page from the request
          $search = $request->query('search');
          $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided
      
          // Query certifications with optional search
          $offices = Office::with('office_under')->when($search, function ($query, $search) {
                  return $query->where('office', 'like', '%' . $search . '%')
                  ->orWhereHas('office_under', function ($q) use ($search) {
                    $q->where('head_of_office', 'like', '%' . $search . '%');
                });
          })
          ->paginate($perPage);
      
          return response()->json([
              'success' => true,
              'data' => $offices
          ]);
    }

    public function update_office(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'head_of_office' => 'required',
             'office' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
       
        try {
            $office =  Office::find($id);
            $office->head_office_id = $request->head_of_office;
            $office->office = $request->office;
             $office->status = $request->status;
            $office->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Office  Updated successfully',
                'data' => $office
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function ticket_type ()
    {
        return view('admin.ticket_type');
    }
    public function ticket_category()
    {
        return view('admin.ticket_category');
    }
    public function store_ticket_type(Request $request){
        $validator = Validator::make($request->all(), [
            'ticket_type' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        if (TicketType::where('ticket_type', $request->ticket_type)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'The Ticket Type already exists.'
            ], 409); // 409 Conflict status code
        }
    
        try {
            $ticket = new TicketType;
            $ticket->ticket_type = $request->ticket_type;
            $ticket->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Ticket Type created successfully',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDataTicketType(Request $request){
         $search = $request->query('search');
           $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided
       
           // Query certifications with optional search
           $tickets = TicketType::when($search, function ($query, $search) {
               return $query->where('ticket_type', 'like', '%' . $search . '%');
                           
           })
           ->paginate($perPage);
       
           return response()->json([
               'success' => true,
               'data' => $tickets
           ]);
    }
     public function update_ticket_type(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'ticket_type' => 'required',
           
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
       
        try {
            $ticket =  TicketType::find($id);
            $ticket->ticket_type = $request->ticket_type;
           
             $ticket->status = $request->status;
             $ticket->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Ticket Type  Updated successfully',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Ticket Type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

     public function delete_ticket_type(Request $request, $id)
    {
        try {
            $ticket = TicketType::find($id);
            
            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket Type not found'
                ], 404);
            }
            
            $ticket->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ticket Type deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the Ticket Type',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function user_management(){
        return view('admin.user_management');
    }

    public function getDataUserPending(Request $request){
        // Get the search query and per_page from the request
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided

        // Query users with optional search
        $users = User::with('module_system')->with('headOffice')->with('office')->when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('firstname', 'like', '%' . $search . '%')
                  ->orWhere('middle_initial', 'like', '%' . $search . '%')
                  ->orWhere('lastname', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orWhereHas('headOffice', function ($q) use ($search) {
                $q->where('head_of_office', 'like', '%' . $search . '%');
            })
            ->orWhereHas('office', function ($q) use ($search) {
                $q->where('office', 'like', '%' . $search . '%');
            });
        })
        ->where('role','!=','admin')
        ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function getModuleAssign()
{
            $moduled = SystemModule::orderBy('module_assign', 'asc')->get();
            return response()->json($moduled);
        }

        public function update_user_account(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 
            'approval_status' => 'required',
             'module_assign_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->approval_status = $request->approval_status;
            $user->module_assign = $request->module_assign_name;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User account updated successfully',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the user account',
                'error' => $e->getMessage()
            ], 500);
        }
        }

        public function store_ticket_category(Request $request){
        $validator = Validator::make($request->all(), [
            'ticket_type' => 'required',
            'ticket_category' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        if (TicketCategory::where('ticket_category', $request->ticket_category)
        ->where('ticket_type_id', $request->ticket_type)
        ->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'The Ticket Category already exists under the selected Ticket Type.',
            ], 409); // 409 Conflict status code
            }
    
        try {
            $ticket_category = new TicketCategory;
            $ticket_category->ticket_type_id = $request->ticket_type;
            $ticket_category->ticket_category = $request->ticket_category;
            $ticket_category->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Ticket category successfully',
                'data' => $ticket_category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Ticket Category',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function getDataTicketCategory(Request $request){
         // Get the search query and per_page from the request
           // Get the search query and per_page from the request
          $search = $request->query('search');
          $perPage = $request->query('per_page', 10); // Default to 10 if per_page is not provided
      
          // Query certifications with optional search
          $categories = TicketCategory::with('ticket_type')->when($search, function ($query, $search) {
                  return $query
                     ->where('ticket_category', 'like', '%' . $search . '%')
                  ->orWhereHas('ticket_type', function ($q) use ($search) {
                    $q->where('ticket_type', 'like', '%' . $search . '%');
                });
          })
          ->paginate($perPage);
      
          return response()->json([
              'success' => true,
              'data' => $categories
          ]);
    }

    public function update_ticket_category(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'ticket_category' => 'required',
            'ticket_type' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
       
        try {
            $ticket_category =  TicketCategory::find($id);
            $ticket_category->ticket_category = $request->ticket_category;
            $ticket_category->ticket_type_id = $request->ticket_type;
            $ticket_category->status = $request->status;
            $ticket_category->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Ticket Category Updated successfully',
                'data' => $ticket_category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the Ticket Category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_ticket_category($id){
        try {
            $category = TicketCategory::find($id);
            
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket Category not found'
                ], 404);
            }
            
            $category->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ticket Category deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the Office Head',
                'error' => $e->getMessage()
            ], 500);
        }
    }



          




}
