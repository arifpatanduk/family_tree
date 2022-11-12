@extends('layout')

@section('content')
    <a href="/" class="btn btn-secondary">Kembali</a>

    <h3 class="my-2">Tambah Data</h3>
        
    <div class="my-2">
        <form action="{{ route('family.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name">

                @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                    <option value="">Pilih Gender</option>
                    @foreach ($genders as $key => $gender)
                    <option value="{{ $key }}">{{ $gender }}</option>
                    @endforeach
                  </select>

                  @error('gender')
                  <div class="text-danger mt-2">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3">
                <label for="parent" class="form-label">Parent</label>
                <select class="form-select" aria-label="Default select example" id="parent" name="parent">
                    <option value="">Pilih Parent</option>
                    @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                  </select>

                  @error('parent')
                  <div class="text-danger mt-2">{{ $message }}</div>
                  @enderror
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection