{{-- php code for the statuses --}}
@php
    $statuses = ['Draft', 'Published', 'Validate', 'Done'];
@endphp

@extends('layout.mainLayout')

@section('mainContent')
    <div class="text-center mt-3 mb-1">
        <h3>Create New Task</h3>
    </div>

    {{-- <div class="modal" style="background-color:rgba(255, 255, 255, 0.744)">
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
    </div> --}}
    <form class="mt">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection



