{{-- php code for the statuses --}}
@php
    $statuses = ['Draft', 'Published', 'Validate', 'Done'];
@endphp


@extends('layout.mainLayout')

@section('mainContent')
    <div class="text-center">
        <h3>Task List</h3>
    </div>

    <div>
        {{-- data is here --}}
        @foreach ($datas as $status_id => $items)
            <h3 class="mb-4 mt-5 ms-3">{{ $statuses[$status_id - 1] }}</h3>
            <div class="row row-cols-1 row-cols-md-5 g-2 m-2">
                @foreach ($items as $item)
                    <div class="col">
                        <div class="card h-100">
                            {{-- {{ $item->image }} --}}
                            <img src="{{ $item->image->path }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                                <div class="text-center">
                                    <a href="{{ route('editTask', ['id' => $item->id]) }}" class="btn btn-primary">Edit</a>
                                    {{-- <a href="" id="deleteButton" class="btn btn-primary">Delete</a> --}}
                                    <button type="button" class="btn btn-primary" onclick="openModal({{ $item->id }})">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="modal" style="background-color:rgba(255, 255, 255, 0.744)">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close" onclick="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary cancel"
                        data-bs-dismiss="modal">Cancel</a>
                    <form id='deleteForm' action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-primary confirm"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



