@extends('layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3">Bookings</h1>

                @auth
                    @if(auth()->user()->role == 'admin')
                        <div class="d-flex justify-content-start mb-6 mb-3">              
                            <button type="button" class="create-btn btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#create-modal">
                                + Create New Booking
                            </button>                            
                        </div>
                    @endif
                @endauth

                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->code }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->type }}</td>
                                <td>{{ $booking->description }}</td>
                                <td class="text-center">{{ $booking->status == "0" ? "Available" : "Not Available" }}</td>

                                @auth
                                    @if(auth()->user()->role == 'admin')
                                        <td class="text-center">                                    
                                            <a href="javascript:void(0)"
                                                class="edit-btn btn btn-primary btn-sm "
                                                data-id="{{ $booking->id }}"
                                                data-name="{{$booking->name}}" 
                                                data-type="{{$booking->type}}"
                                                data-description="{{$booking->description}}">
                                                <i class="fa-regular fa-pen-to-square text-black"></i>
                                            </a>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')"><i class="fa-regular fa-trash-can text-black"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                @endauth

                                @auth
                                    @if(auth()->user()->role == 'user')
                                        <td class="text-center">  
                                            <button 
                                                type="button" 
                                                class="request-btn btn btn-info btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#request-modal" 
                                                data-id="{{ $booking->id }}"
                                                {{ $booking->status == "1" ? "disabled" : "" }}>Book
                                            </button> 
                                        </td>
                                    @endif
                                @endauth                               
                            </tr>                          
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>                          
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $bookings->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    
{{-- Create Modal --}}
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


{{-- Edit Modal --}}
    <div class="modal fade" id="edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: #e4571f">Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="edit-form" class="p-4 md:p-5">
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
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
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


{{-- Request Modal --}}
    <div class="modal fade" id="request-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: #e4571f">Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="request-form" class="p-4 md:p-5">
                        @csrf       
    
                        <div class="alert alert-danger error-messages" hidden>
                            <ul>                
                                                    
                            </ul>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="col-12">
                                <label for="contact" class="form-label">Contact No. </label>
                                <input type="number" name="contact" id="contact" class="form-control" value="{{ old('contact') }}">
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                            </div>
                            <div class="col-6">
                                <label for="borrowed_at" class="form-label">Borrow At</label>
                                <input type="dateTime-local" name="borrowed_at" id="borrowed_at" class="form-control" value="{{ old('borrowed_at') }}">
                            </div>
                            <div class="col-6">
                                <label for="returned_at" class="form-label">Return At</label>
                                <input type="dateTime-local" name="returned_at" id="returned_at" class="form-control" value="{{ old('returned_at') }}">
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