<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadOffice;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // ✅ Add this line
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }
     public function register()
    {
        return view('auth.request_access');
    }
     public function post_login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email_address' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422); // Use 422 for validation errors
    }

    if (Auth::attempt(['email' => $request->input('email_address'), 'password' => $request->input('password')])) {
        $user = Auth::user();

        if ($user->role === "admin") {
            return redirect()->route('dashboard');
        }
        if ($user->module_assign == 1  && $user->approval_status === "Approved") {
            return redirect()->route('helpdesk.dashboard');
        }
        if ($user->approval_status === "Pending") {
            Auth::logout();
            return response()->json([
                'error' => 'Your account is currently pending approval from an administrator. Please reach out to your administrator for further assistance.'
            ], 401);
        }
         else {
            Auth::logout();
            return response()->json([
                'error' => 'Your Email address or Password is incorrect. Please try again.'
            ], 401);
        }
    }

    return response()->json([
        'error' => 'Your Email address or Password is incorrect. Please try again.'
    ], 401);
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
    public function register_user(Request $request)
    {
        $validated = $request->validate([
            'firstname'            => 'required',
            'middle_initial'       => 'nullable',
            'lastname'             => 'required',
            'extension'            => 'nullable',
            'email_address'        => 'required|email|unique:users,email',
            'contact_number'       => 'required|string|min:11|max:15',
            'position'             => 'required|string|max:255',
            'head_office'          => 'required|integer|exists:head_office_tbl,id',
            'office'               => 'required|integer|exists:office_tbl,id',
            'password'             => 'required|string|min:8|confirmed',
            'terms'                => 'required|accepted',
        ]);

        $user = User::create([
            'firstname'                   => $validated['firstname'],
             'middle_initial'                   => $validated['middle_initial'],
              'lastname'                   => $validated['lastname'],
               'extension'                   => $validated['extension'],
            'email'                       => $validated['email_address'],
            'contact_number'              => $validated['contact_number'],
            'position'                    => $validated['position'],
            'head_office_id'              => $validated['head_office'],
            'office_id'                   => $validated['office'],
            'approval_status'             => 'Pending',
            'agree_and_terms_condition'   => true,
            'information_confirmed'       => true,
            'password'                    => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'data'    => [
                'user_id' => $user->id,
                'email'   => $user->email,
            ],
        ], 201);
    }

            public function showProfile($id)
        {
            // Optional: make sure user can only view their own profile
            if (Auth::id() != $id) {
                abort(403, 'Unauthorized access.');
            }

            $user = Auth::user(); // or User::findOrFail($id);

            return view('profile.show', compact('user'));
        }


}
