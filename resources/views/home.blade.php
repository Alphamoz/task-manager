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
            <h3 class="mb-4 mt-5 ms-3">{{ $statuses[$status_id-1]}}</h3>
            <div class="row row-cols-1 row-cols-md-3 g-2 m-2">
            @foreach ($items as $item)
            <div class="col">
                <div class="card">
                    {{ $item->image }}
                    <img src="{{ $item->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endSection
