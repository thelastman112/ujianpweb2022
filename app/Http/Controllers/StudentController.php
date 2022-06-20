<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get users that not in students, and not in admins
        $users = User::whereNotIn('id', function ($query) {
            $query->select('user_id')->from('students');
        })->whereNotIn('id', function ($query) {
            $query->select('model_id')->from('model_has_roles');
        })->get();
        $students = Student::orderBy('id', 'desc')->get();
        return view('students.index', compact('students', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        // dd($request->all());
        if ($request->isRegistered == 'on') {
            $id = $request->user_id;
            $user = User::find($id);

            $student = Student::create([
                'user_id' => $id,
                'name' => $user->name,
                'nim' => $request->nim,
                'address' => $request->address,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
            ]);
        } else {
            $user = User::create([
                'username' => $request->nim,
                'name' => $request->name,
                'email' => $request->nim . '@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
            $user->assignRole('student');
            $id = $user->id;

            $student = Student::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
            ]);
        }

        // if process failed, redirect to response with error message
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create student',
            ])->setStatusCode(400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Student created successfully',
            'data' => $student,
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        // if process failed, redirect to response with error message
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find student',
            ])->setStatusCode(400);
        }

        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::find($id);

        $student->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
        ]);

        $user = User::find($student->user_id);
        $user->update([
            'name' => $request->name,
        ]);

        // if process failed, redirect to response with error message
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update student',
            ])->setStatusCode(400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Student updated successfully',
            'data' => $student,
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        // if process failed, redirect to response with error message
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to find student',
            ])->setStatusCode(400);
        }

        $student->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
