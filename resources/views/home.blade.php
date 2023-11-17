{{-- php code for the statuses --}}
@php
    $statuses = ['Draft', 'Published', 'Validate', 'Done', 'Users'];
@endphp


@extends('layout.mainLayout')

@section('search')
    @parent
@endsection

@section('mainContent')
    <div class="text-center mt-3 mb-1 position-relative">
        <h1 class="h3">Task List</h1>
        @if (Auth::user()->is_admin)
            <a class="position-absolute btn btn-primary d-inline top-0 end-0 me-3" href="{{ route('newTask') }}"
                role="button">New
                Task</a>
        @endif
        <div class="position-absolute top-3 start-0 ms-3">
            @if (Auth::user()->is_admin)
                <a class="btn btn-outline-secondary d-inline" href="{{ route('homeScreen') }}?status=draft"
                    role="button">Draft</a>
            @endif
            <a class="btn btn-outline-secondary d-inline" href="{{ route('homeScreen') }}?status=published"
                role="button">Published</a>
            <a class="btn btn-outline-secondary d-inline" href="{{ route('homeScreen') }}?status=validated"
                role="button">Validated</a>
            @if (Auth::user()->is_admin)
                <a class="btn btn-outline-secondary d-inline" href="{{ route('homeScreen') }}?status=done"
                    role="button">Done</a>
                <a class="btn btn-outline-secondary d-inline" href="{{ route('homeScreen') }}?status=user"
                    role="button">Users</a>
            @endif
        </div>
    </div>

    <div>
        {{-- data is here --}}
        @foreach ($datas as $status_id => $items)
            <h3 class="mb-4 mt-5 ms-3">{{ $statuses[$status_id - 1] }}</h3>
            <div class="row row-cols-1 row-cols-md-5 g-2 m-2">
                @foreach ($items as $item)
                    @if ($statuses[$status_id - 1] == 'Users')
                    <div class="col">
                        <div class="card h-100">
                            {{-- {{ $item->image }} --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ Str::limit($item->email) }}</p>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="col">
                            <div class="card h-100">
                                {{-- {{ $item->image }} --}}
                                <img src="{{ $item->image->path }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                                    <div class="text-center">
                                        <a href="{{ route('editTask', ['id' => $item->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                        {{-- <a href="" id="deleteButton" class="btn btn-primary">Delete</a> --}}
                                        @if (Auth::user()->is_admin)
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="openModal({{ $item->id }})">Delete</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="modal" style="background-color:rgba(255, 255, 255, 0.744)">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-outline-secondary cancel" data-bs-dismiss="modal">Cancel</a>
                    <form id='deleteForm' action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-outline-danger confirm"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @dd($paginated) --}}

@section('pagination')
    @if ($paginated)
        <div class="d-flex justify-content-center mt-5">{{ $datas->first->links() }}</div>
    @endif
@endsection
