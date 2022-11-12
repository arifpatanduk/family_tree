@extends('layout')

@section('content')
    <a href="{{ route('family.create') }}" class="btn btn-success">+ Tambah Data</a>

    @if (session('success'))
    <div class="my-2 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        @include('family-tree', compact('families'))
    </div>

@endsection