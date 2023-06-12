@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($data->isEmpty())
                    <p>Tidak ada data pesanan.</p>
                @else
                    <h6>Transaction ID : </h6>
                    <h3 class="fw-bold">{{ $data[0]->transaction_id }}</h3><br>
                    <h6>Price : </h6>
                    <h3 class="fw-bold">{{ $data[0]->total_price }}</h3><br>
                    <h6>Payment Method : </h6>
                    <h3 class="fw-bold">{{ $data[0]->payment_method }}</h3><br>
                    <h6>Payment Status : </h6>
                    <h3 class="fw-bold">{{ $data[0]->payment_status }}</h3><br>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
