@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Event Management</h2>
                    <a class="btn btn-success" href="{{ route('event.create') }}">Add New Event</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                            @if ($event->image)
                                <img src="{{ Storage::url($event->image) }}" width="100" height="100"
                                    alt="{{ $event->title }}" class="mt-2">
                            @else
                                <img src="https://via.placeholder.com/100" width="100px" alt="No Image">
                            @endif
                        </td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('event.edit', $event->id) }}">Edit</a>
                            <form action="{{ route('event.delete', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No events found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
