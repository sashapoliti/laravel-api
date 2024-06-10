@extends('layouts.admin')
@section('title', 'Technologies')

@section('content')
    <section class="mt-4 p-3">
        <!-- Messaggio di successo -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center py-4">
            <h1>Technologies</h1>
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">Add new technology</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Update At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->id }}</th>
                        <td>{{ $technology->name }}</td>
                        <td>{{ $technology->slug }}</td>
                        <td>{{ $technology->created_at }}</td>
                        <td>{{ $technology->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.technologies.show', $technology->slug) }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.technologies.edit', $technology->slug) }}"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.technologies.destroy', $technology->slug) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button technology="submit" class="delete-button border-0 bg-transparent"
                                    data-item-title="{{ $technology->name }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
@include('partials.modal-delete')
