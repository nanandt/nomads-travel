@extends('layouts.checkout')
@section('title', 'Checkout')

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container">
            <div class="row">
                <div class="col p-o">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                Paket Travel
                            </li>
                            <li class="breadcrumb-item">
                                Details
                            </li>
                            <li class="breadcrumb-item active">
                                checkout
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h1>Who is Going?</h1>
                        <p>
                            Trip to {{  $item->travel_package->title }}, {{  $item->travel_package->location }}
                        </p>
                        <div class="attendee">
                            <table class="table table-responsive-sm text-center">
                                <thead>
                                    <tr>
                                        <td>Picture</td>
                                        <td>Name</td>
                                        <td>Nationalty</td>
                                        <td>Email</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->details as $detail)
                                    <tr>
                                        <td>
                                            <img src="https://ui-avatars.com/api/?name={{ $detail->username }}" height="60" class="rouded-circle">
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->username }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->nationality }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->email }}
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('checkout-remove', $detail->id) }}">
                                            <img src="{{ url('frontend/images/ic_remove.png') }}" alt="">
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No Visitor
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="member mt-3">
                            <h2>Add Member</h2>
                            <form class="form-inline" method="POST" action="{{ route('checkout-create', $item->id) }}">
                                @csrf
                                <label for="username" class="sr-only">
                                    Name
                                </label>
                                <input type="text" name="username" required class="form-control mb-2 mr-sm-2"
                                    id="username" placeholder="Username">

                                <label for="nationality" class="sr-only">
                                    Nationality
                                </label>
                                <input type="text" name="nationality" required class="form-control mb-2 mr-sm-2" style="width: 50px"
                                    id="nationality" placeholder="Nationality">

                                <label for="email" class="sr-only">
                                    Email
                                </label>
                                <input type="text" name="email" class="form-control mb-2 mr-sm-2"
                                    id="email" placeholder="Email">

                                <button type="submit" class="btn btn-add-now mb-2 px-4">Add Now</button>
                            </form>
                            <h3 class="mt-2 mb-0">
                                Note
                            </h3>
                            <p class="disclaimer mb-0">
                                You are only able to invite member that has registered in Nomads.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-details card-right">
                        <h2>Checkout Informations</h2>
                        <table class="trip-informations">
                            <tr>
                                <th width="50%">Members</th>
                                <td width="50%" class="text-right">{{ $item->details->count() }} person</td>
                            </tr>
                            <tr>
                                <th width="50%">Trip Price</th>
                                <td width="50%" class="text-right">@currency($item->travel_package->price)/org</td>
                            </tr>
                            <tr>
                                <th width="50%">Sub Total</th>
                                <td width="50%" class="text-right">@currency($item->transaction_total)</td>
                            </tr>

                        </table>
                        <hr>
                        <h2>Payment Instructions</h2>
                        <p class="payment-intructions">
                            Please complete your payment before to
                            continue the wonderful trip
                        </p>
                        <div class="bank">
                            <div class="bank-item pb-3">
                            <img src="{{ url('frontend/images/ic_bank.png') }}" alt="" class="bank-image">
                                <div class="descriptions">
                                    <h3>
                                        PT Nomads ID
                                    </h3>
                                    <p>
                                        0881 8829 8800
                                        <br>
                                        Bank Central Asia
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="bank-item pb-3">
                            <img src="{{ url('frontend/images/ic_bank.png') }}" alt="" class="bank-image">
                                <div class="descriptions">
                                    <h3>
                                        PT Nomads ID
                                    </h3>
                                    <p>
                                        0899 8501 7888
                                        <br>
                                        Bank HSBC
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="join-container">
                        <a href="{{ route('checkout-success', $item->id) }}" class="btn btn-block btn-join-now mt-3 my-2">I Have Made Payment</a>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('detail', $item->travel_package->slug) }}" class="text-muted">Cancel Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}">
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" />'
                }
            })
        });

    </script>
@endpush