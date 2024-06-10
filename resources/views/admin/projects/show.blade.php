@extends('layouts.admin')
@section('title', $project->title)

@section('content')
<section>
    <h1>{{$project->title}}</h1>

    <p>{!! $project->content !!}</p>
    <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/300x200' }}" alt="Image of {{$project->title}}">
    <p>{{$project->type ? $project->type->name : 'No type'}}</p>
    @if ($project->technologies)
        <ul>
            @foreach ($project->technologies as $technology)
                <li>
                    <span class="badge bg-primary">{{$technology->name}}</span>
                </li>
            @endforeach
        </ul>
    @endif
</section>
@endsection
