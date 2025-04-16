@extends('layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3">Bookings</h1>

                <div class="d-flex justify-content-start mb-6 mb-3">              
                    <button type="button" class="create-btn btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create-modal">
                        + Create New Booking
                    </button>                            
                </div>

                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: #e4571f">Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="create-form" class="p-4 md:p-5">
                        @csrf       
    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif 
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                    
                            <div class="col-12">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" name="type" id="type" class="form-control">
                            </div>
                    
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-3 justify-content-end">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

<script src="{{asset("js/jquery-3.7.1.min.js")}}" ></script>
<script src="{{asset("js/custom.js")}}" ></script>

@endsection

