@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Halaman Student</h1>
        <div class="accordion mb-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Tambahkan Mahasiswa Baru
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('students.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameId"
                                    placeholder="Nama">
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" id="nim" aria-describedby="nimId"
                                    placeholder="NIM">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    aria-describedby="addressId" placeholder="Address">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneId"
                                    placeholder="Phone">
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="text" class="form-control" name="birth_date" id="birth_date"
                                    aria-describedby="birth_dateId" placeholder="Birth Date">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Birth Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nim }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->birth_date }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" id="students_delete"
                                data-id="{{ $student->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
