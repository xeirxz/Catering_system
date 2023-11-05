@extends('customer.dashboard')


@section('customer')
    <div class="page-content">

        {{-- <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        Hello World
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        Hello World
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-body"style="overflow-y: auto;">
                <h3>Menu</h3> <br>

                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($byPrice as $price)
                            @if ($price->category_id == 1)
                                @php
                                $previousLine = null;
                                @endphp
                                <div class="col-md-6 grid-margin"> <!-- Set the column width as needed -->
                                    <div class="card" > <!-- Start a card for each category -->
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($dataPack as $pack)
                                                    @if ($pack->price_id == $price->id)
                                                        @if ($pack->variant != $previousLine)
                                                            @if ($previousLine !== null)
                                                            </ul>
                                                        </div>
                                                    </div> <br> <!-- Close the previous card -->
                                                    <div class="card"> <!-- Open a new card for the new line -->
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                            @endif
                                                            <li class="list-group-item">
                                                                <input type="radio" value="{{ $pack->id }}" style="margin-right: 10px" class="form-check-input" name="radioLine_{{ $pack->variant }}[]" id="radioDefault_{{ $pack->variant }}">
                                                                {{$pack->menu}}
                                                            </li>
                                                            @php
                                                            $previousLine = $pack->variant;
                                                            @endphp
                                                        @else
                                                            <li class="list-group-item">
                                                                <input type="radio" value="{{ $pack->id }}" style="margin-right: 10px" class="form-check-input" name="radioLine_{{ $pack->variant }}[]" id="radioDefault_{{ $pack->variant }}">
                                                                {{$pack->menu}}
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div> <!-- Close the last card -->
                                </div>
                            @endif
                        @endforeach
                    </div> <br>

            </div>
            <button type="button" style="margin: 20px"  class="btn btn-primary">Order</button>
                </form>
        </div>


    </div>
@endsection
