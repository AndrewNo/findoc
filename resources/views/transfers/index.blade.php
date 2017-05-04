@extends('base')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/transfer.css') }}">
@endsection

@section('content')
    <h3>Add new transfer</h3>
    <div class="add_transfer">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </div>
    <div class="modal_bg">
        <div class="modal_container">
            <h3>Create transfer</h3>
            <form action="">
                <label for="account_from">From account:</label>
                <select name="account_from" id="account_from">
                    <option value="" selected disabled="">Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <span><i class="fa fa-exchange" aria-hidden="true"></i></span>
                <label for="account_to">To account:</label>
                <select name="account_to" id="account_to">
                    <option value="" disabled selected>Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <label for="total_sum">Sum:</label>
                <input type="number" step="0.01" name="total_sum" id="total_sum">
                {{ csrf_field() }}
                <input type="submit">
            </form>
            <button id="exit_modal">Exit</button>
        </div>
    </div>
@endsection