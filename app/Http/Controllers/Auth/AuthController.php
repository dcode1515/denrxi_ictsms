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
use Carbon\Carbon;


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

                // Get user with relationships (Auth::user() already gives current user)
                $user = Auth::user()->load(['headOffice', 'office']);

                return view('profile.show', compact('user'));
            }


            public function update_profile(Request $request, $id)
                {
                    $validator = Validator::make($request->all(), [
                        'firstname'        => 'required|string|max:255',
                        'middle_initial'   => 'nullable|string|max:1',
                        'lastname'         => 'required|string|max:255',
                        'extension'        => 'nullable|string|max:10',
                        'contact_number'   => ['required', 'regex:/^[0-9]{11}$/'],
                        'position'         => 'required|string|max:255',
                        'photo'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    ], [
                        'contact_number.regex' => 'The contact number must be exactly 11 digits and contain numbers only.',
                        'contact_number.required' => 'The contact number is required.',
                        'photo.image'      => 'The uploaded file must be an image.',
                        'photo.mimes'      => 'The photo must be a file of type: jpeg, png, jpg.',
                        'photo.max'        => 'The photo must not be greater than 2MB.',
                        'firstname.required' => 'The first name is required.',
                        'lastname.required'  => 'The last name is required.',
                        'position.required'  => 'The Position is required.',
                    ]);

                    // Check if validation fails
                    if ($validator->fails()) {
                        return response()->json(['errors' => $validator->errors()], 422);
                    }

                    try {
                        $user = User::findOrFail($id);
                        $user->firstname = $request->input('firstname');
                        $user->middle_initial = $request->input('middle_initial');
                        $user->lastname = $request->input('lastname');
                        $user->extension = $request->input('extension');
                        $user->contact_number = $request->input('contact_number');
                        $user->position = $request->input('position');
                        
                        if ($request->hasFile('photo')) {
                            $file = $request->file('photo');
                            $ext = $file->extension();
                            $now = Carbon::now();
                            $name = str_replace(' ', '_', strtoupper($user->firstname . '_' . $user->middle_initial . '_' . $user->lastname));
                            $contact = $user->contact_number;
                            $fileName = $now->year . '-' . $name . '-' . $contact . '.' . $ext;

                            // Ensure the directory exists
                            $directory = public_path('user/profile/' . $user->firstname . '_' . $user->lastname);
                            if (!file_exists($directory)) {
                                mkdir($directory, 0777, true);
                            }

                            // Delete old photo if exists
                            if ($user->photo && file_exists($directory . '/' . $user->photo)) {
                                unlink($directory . '/' . $user->photo);
                            }

                            // Move the file to the desired location
                            $file->move($directory, $fileName);
                            $user->photo = $fileName;
                        }
                        
                        $user->save();

                        return response()->json([
                            'success' => true,
                            'message' => 'Profile updated successfully',
                            'user' => $user
                        ], 200);
                    } catch (\Exception $e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'An error occurred while updating the profile',
                            'error' => $e->getMessage()
                        ], 500);
                    }
                }

                public function update_user_credentials(Request $request, $id)
{
    try {
        // Validate the incoming data
        $validated = $request->validate([
            'email' => 'nullable|email|max:255|unique:users,email,'.$id,
            'password' => [
                'required',
                'min:8',
                'same:confirm_password',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            'confirm_password' => 'required|min:8',
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'password.same' => 'The password and confirm password must match.',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update email if provided
        if ($request->has('email')) {
            $user->email = $request->email;
        }

        // Update password if provided
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user
        $user->save();

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'User credentials updated successfully!',
            'data' => $user
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Format validation errors for frontend
        $errors = collect($e->errors())->map(function ($messages, $field) {
            return $messages[0]; // Get the first error message for each field
        })->all();

        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating the account',
            'error' => $e->getMessage()
        ], 500);
    }
}



}
