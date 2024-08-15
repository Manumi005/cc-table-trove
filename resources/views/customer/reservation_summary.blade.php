@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reservation Summary</h1>
    <p>Restaurant: {{ $reservation->restaurant->name }}</p>
    <p>Date: {{ $reservation->reservation_date }}</p>
    <p>Time Slot: {{ $reservation->time_slot }}</p>
    <p>Party Size: {{ $reservation->party_size }}</p>
    <p>Status: 
        @if($reservation->status == 'approved')
            <span class="text-success">Approved</span>
        @elseif($reservation->status == 'declined')
            <span class="text-danger">Declined</span>
        @else
            <span class="text-warning">Pending</span>
        @endif
    </p>
    @if($reservation->status == 'approved')
        <p>Your reservation has been successfully confirmed!</p>
    @elseif($reservation->status == 'declined')
        <p>Sorry, your reservation was declined.</p>
    @else
        <p>Your reservation is pending approval.</p>
    @endif
</div>
@endsection
