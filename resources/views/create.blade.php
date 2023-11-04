{{-- php code for the statuses --}}
@php
    $statuses = ['Draft', 'Published', 'Validate', 'Done'];
@endphp

@extends('layout.mainLayout')

{{-- without search bar --}}
@section('search')
@endsection

@section('mainContent')
    <div class="text-center mt-3 mb-1">
        <h3>Create New Task</h3>
    </div>

    <form class="m-5" action="{{ route('createTask') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <label class="input-group-text" for="user">Select User</label>
            <select name="user_id" id='user' class="form-select" aria-label="Default select example" default="">
                <option selected value="">Select PIC</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image">Select Image Task</label>
            <select name="image_id" id='image' class="form-select" aria-label="Default select example">>
                <option selected>Select Image</option>
                @foreach ($images as $image)
                    <option value="{{ $image->id }}">{{ Str::limit($image->description, 100) }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3">
            {{-- <span class="input-group-text" id="description">""</span> --}}
            <input type="text" class="form-control" placeholder="Title" name="title" aria-label="title"
                aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            {{-- <span class="input-group-text" id="description">""</span> --}}
            <input type="text" class="form-control" placeholder="Description" name="description" aria-label="description"
                aria-describedby="basic-addon1">
        </div>
        <div class="d-flex gap-2 justify-content-center">
            <input type="submit" name="save" class="btn btn-primary" value="Save">
        <input type="submit" name="publish" class="btn btn-primary" value="Publish">
        </div>

    </form>
@endsection
