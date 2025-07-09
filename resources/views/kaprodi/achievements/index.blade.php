@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Achievements for Validation</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Student</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($achievements as $achievement)
                <tr>
                    <td>{{ $achievement->title }}</td>
                    <td>{{ $achievement->user->name }}</td>
                    <td>{{ $achievement->status }}</td>
                    <td>
                        <a href="{{ route('kaprodi.achievements.show', $achievement) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
