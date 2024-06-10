@extends('layouts.admin')
@section('title', 'Edit Project')

@section('content')
    <section class="mt-4 p-3">
        <h2>Edit project</h2>
        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="@if(old('title')) {{ old('title') }} @else {{ $project->title }} @endif">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 d-flex">
                <div class="media me-4">
                    <img class="shadow" id="uploadPreview" width="150" src="{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/300x200' }}" alt="Preview image {{ $project->title }}">
                </div>
                <div>
                    <label for="image" class="form-label">Image</label>
                    <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="uploadImage"
                        name="image" value="@if(old('image')) {{ old('image') }} @else {{ $project->image }} @endif">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                    @if(old('description')) {{ old('description') }} @else {{ $project->description }} @endif
                </textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="technologies" class="form-label">Technologies</label>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                            id="technology-{{ $technology->id }}" name="technologies[]"
                            {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="technology-{{ $technology->id }}">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </section>
@endsection
