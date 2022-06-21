<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        //
    }

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
