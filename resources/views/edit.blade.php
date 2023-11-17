{{-- php code for the statuses --}}
@php
    $statuses = ['Draft', 'Published', 'Validate', 'Done'];
@endphp

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
    @endforeach
</ul>
</div>

@endif
@extends('layout.mainLayout')

{{-- without search bar --}}
@section('search')
@endsection

@section('mainContent')
    <div class="text-center mt-3 mb-1">
        <h3>Create New Task</h3>
    </div>

    <form class="m-5" action="{{ route('updateTask', ['id' => $datas->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group mb-3">
            <label class="input-group-text" for="user">Select User</label>
            <select name="user_id" id='user' class="form-select" aria-label="Default select example" default="" value="{{ $datas->user_id }}" {{ Auth::user()->is_admin? "" : "disabled" }}>
                <option selected value="{{$datas->user_id??null}}">{{ $datas->user->name ?? null}}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image">Select Image Task</label>
            <select name="image_id" id='image' class="form-select" aria-label="Default select example" {{ Auth::user()->is_admin? "" : "disabled" }}>
                <option selected value="{{ $datas->image_id }}">{{ Str::limit($datas->image->description,100)}}</option>
                @foreach ($images as $image)
                    <option value="{{ $image->id }}">{{ Str::limit($image->description, 100) }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group mb-3">
            {{-- <span class="input-group-text" id="description">""</span> --}}
            <input type="text" class="form-control" placeholder="Title" name="title" aria-label="title"
                aria-describedby="basic-addon1" value="{{ $datas->title }}" {{ Auth::user()->is_admin? "" : "disabled" }}>
        </div>
        <div class="input-group mb-3">
            {{-- <span class="input-group-text" id="description">""</span> --}}
            <input type="text" class="form-control" placeholder="Description" name="description" aria-label="description"
                aria-describedby="basic-addon1" value="{{ $datas->description }}" {{ Auth::user()->is_admin? "" : "disabled" }}>
        </div>
        @if (!Auth::user()->is_admin)
        <div class="input-group mb-3">
            {{-- <span class="input-group-text" id="description">""</span> --}}
            <input type="text" class="form-control" placeholder="Fill the Note!" name="note" aria-label="description"
                aria-describedby="basic-addon1" value="{{ $datas->note }}">
        </div>
        @endif
        <div class="d-flex gap-2 justify-content-center">
            <input type="submit" name="submit" class="btn btn-outline-primary" value="Save">
            {{-- <input type="submit" name="submit" class="btn btn-outline-primary" value="Publish"> --}}
            @if (Auth::user()->is_admin)
            @if ($datas->status_id==3)
            <input type="submit" name="submit" class="btn btn-outline-success" value="Done">
            @endif
        @endif
        </div>

    </form>
@endsection
