@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Halaman Student</h1>
        <div class="accordion mb-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseAddStudent" aria-expanded="true" aria-controls="collapseAddStudent">
                        Tambahkan Mahasiswa Baru
                    </button>
                </h2>
                <div id="collapseAddStudent" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" id="addStudentForm">
                            @csrf
                            {{-- is account has been created --}}
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="isRegistered"
                                        name="isRegistered">
                                    <label class="form-check-label" for="isRegistered">
                                        Sudah Terdaftar?
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="userId">Akun Yang Belum Terdaftar</label>
                                <select name="user_id" id="userId" class="form-control" disabled>
                                    <option value="">Pilih Akun</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label required">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="nameId" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label required">NIM</label>
                                <input type="text" class="form-control" name="nim" id="nim"
                                    aria-describedby="nimId" placeholder="NIM" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    aria-describedby="addressId" placeholder="Address">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    aria-describedby="phoneId" placeholder="Phone">
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date"
                                    aria-describedby="birth_dateId" placeholder="Birth Date">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="studentTable">
                <thead>
                    <tr class="text-center align-middle text-nowrap">
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Birth Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentData">
                    @foreach ($students as $student)
                        <tr data-id="{{ $student->id }}">
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->nim }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->birth_date }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $student->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm ms-1" id="students_delete"
                                        data-id="{{ $student->id }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="editStudentForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="nameId" placeholder="Nama">
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" id="nim"
                                    aria-describedby="nimId" placeholder="NIM">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    aria-describedby="addressId" placeholder="Address">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    aria-describedby="phoneId" placeholder="Phone">
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date"
                                    aria-describedby="birth_dateId" placeholder="Birth Date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
