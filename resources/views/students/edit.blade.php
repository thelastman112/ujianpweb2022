@extends('layouts.app')

@section('content')
    <div class="container">

        <aside class="col">
            <form action="{{ route('students.update', $student->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameId"
                        placeholder="Nama" value="{{ $student->name }}">
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" name="nim" id="nim" aria-describedby="nimId" placeholder="NIM"
                        value="{{ $student->nim }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </aside>
    </div>
@endsection
