<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserCard;
use Auth;
use Illuminate\Http\Request;

class AddController extends Controller
{
    

 /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

         /**
          * Create a new user instance after a valid registration.
          *
          * @param  array  $data
          * @return \App\User
          */
          protected function create(Request $request)
          {


              // Validate the request data
              $validated = $request->validate([
                  'first_name' => 'required|string|max:255',
                  'last_name' => 'required|string|max:255',
                  'reason' => 'required|string|max:255',
                  'email' => 'required|string|email|max:255',
                  'password' => 'required|string|min:8',
                  'card_id' => 'sometimes|nullable|exists:cards,id', // Assuming 'cards' is your table name and 'id' is the primary key
                  'created_by_id' => 'sometimes|nullable|exists:users,id', // Validate 'created_by_id' exists in 'users' table
              ]);
        
              //Check if the user exist
              $userExists = User::where('email', $validated['email'])->first();


              
              if(!$userExists) {
                // Create the user
                $user = User::create([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'type'=>'1',
                ]);

                
              //Register user role
              $registrationRole = config('panel.registration_default_role');
              if (! $user->roles()->get()->contains($registrationRole)) {
                  $user->roles()->attach($registrationRole);
              }
          
                // Create a user card if card_id and created_by_id are provided
                if (!empty($validated['card_id'])) {
                    $userCard = UserCard::create([
                        'card_id' => $validated['card_id'],
                        'user_id' => $user->id,
                        'created_by_id' => $validated['created_by_id'] ?? Auth::id(), // Default to current user's ID if not provided
                    ]);

                
                }

              } else {

                //User already exists
               
                // Create a user card if card_id and created_by_id are provided
                 if (!empty($validated['card_id'])) {
                $userCard = UserCard::create([
                    'card_id' => $validated['card_id'],
                    'user_id' => $userExists->id,
                    'created_by_id' => $validated['created_by_id'] ?? Auth::id(), // Default to current user's ID if not provided
                ]);

              
            }
              }

              
          
              return redirect('home');
          }
          
}
