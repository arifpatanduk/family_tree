@extends('layout')

@section('content')
    <a href="/" class="btn btn-secondary">Kembali</a>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Hapus
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
            Konfimasi hapus?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            
            <form action="{{ route('family.destroy',$family->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <h3 class="my-2">Edit Data</h3>


    @if (session('failed'))
    <div class="my-2 alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
        
    <div class="my-2">
        <form action="{{ route('family.update', $family->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $family->name }}">

                @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                    <option value="">Pilih Gender</option>
                    @foreach ($genders as $key => $gender)
                    <option value="{{ $key }}" {{ $family->gender == $key ? 'selected' : '' }} >{{ $gender }}</option>
                    @endforeach
                  </select>

                  @error('gender')
                  <div class="text-danger mt-2">{{ $message }}</div>
                  @enderror
            </div>

            @if ($family->parent_id)
            <div class="mb-3">
                <label for="parent" class="form-label">Parent</label>
                <select class="form-select" aria-label="Default select example" id="parent" name="parent">
                    <option value="">Pilih Parent</option>
                    @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" {{ $family->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                    @endforeach
                  </select>

                  @error('parent')
                  <div class="text-danger mt-2">{{ $message }}</div>
                  @enderror
            </div>
            @endif

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection