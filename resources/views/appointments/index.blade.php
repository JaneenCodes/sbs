@extends('layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3">Requests</h1>

                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Booking Name</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->booking->code }}</td>
                                <td>{{ $appointment->booking->name }}</td>
                                <td>{{ $appointment->name }}</td>
                                <td>{{ $appointment->contact }}</td>
                                <td>{{ $appointment->address }}</td>
                                <td>{{ $appointment->borrowed_at }}</td>
                                <td>{{ $appointment->returned_at }}</td>
                                <td class="text-center"> 
                                    @if($appointment->status == "0")
                                        <span class="text-warning">Pending</span>
                                    @elseif ($appointment->status == "1")
                                        <span class="text-success">Approved</span>
                                    @elseif ($appointment->status == "2")
                                        <span class="text-danger">Declined</span>
                                    @elseif ($appointment->status == "3")
                                        <span class="text-danger-emphasis">Cancelled</span>    
                                    @endif
                                </td>
              
                                @auth
                                    @if(auth()->user()->role == 'user')
                                        <td class="text-center">
                                            <a 
                                                href="{{route('appointments.cancel_book', $appointment->id)}}" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to cancel this book?')">Cancel
                                            </a>  
                                        </td>                                       
                                    @endif
                                @endauth         

                                @auth
                                    @if(auth()->user()->role == 'admin')
                                        <td class="text-center">                                           
                                                <button type="submit" 
                                                        class="btn btn-sm btn-primary approve-btn" 
                                                        onclick="return confirm('Are you sure you want to approve this booking?')" 
                                                        data-id="{{$appointment->id}}"
                                                        {{ $appointment->status == "0" ? "enabled" : "disabled" }}>Approve
                                                </button>

                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger decline-btn" 
                                                        onclick="return confirm('Are you sure you want to decline this booking?')" 
                                                        data-id="{{$appointment->id}}"
                                                        {{ $appointment->status == "0" ? "enabled" : "disabled" }}>Decline
                                                </button>
                                        </td>                                              
                                    @endif
                                @endauth                                  
                            </tr>                          
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No records found.</td>
                            </tr>                           
                        @endforelse                                  
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $appointments->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

<script src="{{asset("js/jquery-3.7.1.min.js")}}" ></script>
<script src="{{asset("js/custom.js")}}" ></script>

@endsection