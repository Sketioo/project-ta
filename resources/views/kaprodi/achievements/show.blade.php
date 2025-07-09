@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Achievement Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $achievement->title }}
        </div>
        <div class="card-body">
            <p><strong>Student:</strong> {{ $achievement->user->name }}</p>
            <p><strong>Description:</strong> {{ $achievement->description }}</p>
            <p><strong>Date:</strong> {{ $achievement->date }}</p>
            <p><strong>Status:</strong> {{ $achievement->status }}</p>

            @if ($achievement->file_path)
                <p><a href="{{ asset('storage/' . $achievement->file_path) }}" target="_blank">View Attachment</a></p>
            @endif

            @if ($achievement->status == 'pending')
                <form action="{{ route('kaprodi.achievements.validate', $achievement) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-success">Validate</button>
                </form>
                <form action="{{ route('kaprodi.achievements.reject', $achievement) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
