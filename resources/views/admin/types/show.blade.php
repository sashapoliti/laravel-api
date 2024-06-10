@extends('layouts.admin')
@section('title', $type->name)

@section('content')
    <section>
        <h1>{{ $type->name }}</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Update At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type->projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project->slug) }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.projects.edit', $project->slug) }}"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button border-0 bg-transparent"
                                    data-item-title="{{ $project->title }}">
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
