@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card my-3">
            <div class="card-body">
                @if (!$student)
                    <p>You are not registered yet. Please contact our administrator to register.</p>
                @else
                    <form method="post" id="putAccount">
                        @csrf
                        {{-- edit toggle --}}
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <input type="hidden" name="user_id" value="{{ $student->user_id }}">
                        <input type="hidden" name="role" value="student">
                        <div class="mb-3 row">
                            <button type="button" name="edit" id="edit" class="btn btn-primary">Edit</button>
                            <button type="submit" name="save" id="save" class="btn btn-success"
                                style="display: none;">Save</button>
                            <button type="button" name="cancel" id="cancel" class="btn btn-secondary"
                                style="display: none;">Cancel</button>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label text-nowrap">Name</label>
                            <div class="col-sm-10 border-start">
                                <input type="text" name="name" readonly class="form-control-plaintext" id="name"
                                    value="{{ $student->name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-2 col-form-label text-nowrap">Username</label>
                            <div class="col-sm-10 border-start">
                                <input type="text" name="username" readonly class="form-control-plaintext" id="username"
                                    value="{{ $student->username }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label text-nowrap">NIM</label>
                            <div class="col-sm-10 border-start">
                                <input type="text" name="nim" readonly class="form-control-plaintext" id="nim"
                                    value="{{ $student->nim }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label text-nowrap">Email</label>
                            <div class="col-sm-10 border-start">
                                <input type="email" name="email" readonly class="form-control-plaintext" id="email"
                                    value="{{ $student->email }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-2 col-form-label text-nowrap">Phone</label>
                            <div class="col-sm-10 border-start">
                                <input type="text" name="phone" readonly class="form-control-plaintext" id="phone"
                                    value="{{ $student->phone }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label text-nowrap">Address</label>
                            <div class="col-sm-10 border-start">
                                <input type="text" name="address" readonly class="form-control-plaintext" id="address"
                                    value="{{ $student->address }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="birth_date" class="col-sm-2 col-form-label text-nowrap">Birthday</label>
                            <div class="col-sm-10 border-start">
                                <input type="date" name="birth_date" readonly class="form-control-plaintext"
                                    id="birth_date" value="{{ $student->birth_date }}">
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-body">
                <h1 class="card-title">
                    Change Your Password
                </h1>
                <form action="updatePassword" method="post" id="changePassword">
                    {{-- Criteria1
                    # Input last password
                    # Input new password
                    # Input new password again
                    # Submit button

                    # Don`t forget to add CSRF token --}}
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="email" value="{{ $student->email }}">
                    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
                    <div class="mb-3 row">
                        <label for="old_password" class="col-sm-2 col-form-label text-nowrap">Old Password</label>
                        <div class="col-sm-10 border-start">
                            <input type="text" name="old_password" class="form-control" id="old_password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password" class="col-sm-2 col-form-label text-nowrap">New Password</label>
                        <div class="col-sm-10 border-start">
                            <input type="text" name="new_password" class="form-control" id="new_password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="repeat_new_password" class="col-sm-2 col-form-label text-nowrap">Repeat New
                            Password</label>
                        <div class="col-sm-10 border-start">
                            <input type="text" name="repeat_new_password" class="form-control"
                                id="repeat_new_password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection
