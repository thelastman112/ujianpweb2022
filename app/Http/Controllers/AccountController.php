<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();

        // get student with user.id data
        $student = Student::where('user_id', $auth->id)
            ->join('users', 'users.id', '=', 'students.user_id')
            ->select('students.*', 'users.username', 'users.email')
            ->first();

        return view('home', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student = Student::findOrFail($request->id);
        $student->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'address' => $request->address,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update([
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah'
        ]);
    }

    // Criteria4
    // add new function to update the password
<<<<<<< HEAD
    public function updatePassword(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah'
        ]);
=======
    // Eloquent / raw SQL
    public function updatePassword(Request $request)
    {
        $check = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$check) {
            // return response()->json([
            //     'status' => 'failed',
            //     'messange' => 'unauthorized',
            //     'check' => $check,
            // ])->setStatusCode(403);
            return redirect('/home')->with('unauthorized');
        }
        $user = User::find($request->user_id);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // return response()->json([
        //     'status' => 'success',
        //     'check' => $check,
        // ])->setStatusCode(201);
        return redirect('/home');
>>>>>>> bd358fd3b06aa281ce952d817da5082e6790f06a
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
