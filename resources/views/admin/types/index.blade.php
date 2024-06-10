@extends('layouts.admin')
@section('title', 'Types')

@section('content')
    <section class="mt-4 p-3">
        <!-- Messaggio di successo -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center py-4">
            <h1>Types</h1>
            <a href="{{ route('admin.types.create') }}" class="btn btn-primary">Add new type</a>
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
                @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                        <td>{{ $type->created_at }}</td>
                        <td>{{ $type->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.types.show', $type->slug) }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.types.edit', $type->slug) }}"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button border-0 bg-transparent"
                                    data-item-title="{{ $type->name }}">
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
