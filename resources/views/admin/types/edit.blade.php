@extends('layouts.admin')
@section('title', 'Edit Type')

@section('content')
    <section>
        <div class="d-flex justify-content-between align-items-center py-4">
            <h2>Edit type: {{ $type->name }}</h2>
            <a href="{{ route('admin.types.show', $type->slug) }}" class="btn btn-primary">Show type</a>
        </div>
        <form action="{{ route('admin.types.update', $type->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $type->name) }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </section>
@endsection
