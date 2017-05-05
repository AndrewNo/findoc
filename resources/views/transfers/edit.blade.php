@extends('base')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/transfer_edit.css') }}">
@endsection

@section('content')

        <div class="modal_container">
            <h3>Edit transfer</h3>
            <form action="transfer/add" method="post">
                <label for="account_from">From account:</label>
                <select name="account_from" id="account_from">
                    <option value="" selected disabled="">Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}"
                                data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <span class="currency_from"></span>
                <span><i class="fa fa-exchange" aria-hidden="true"></i></span>
                <label for="account_to">To account:</label>
                <select name="account_to" id="account_to">
                    <option value="" disabled selected>Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}"
                                data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <span class="currency_to"></span>
                <span class="refresh"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                <div class="warning">Different accounts! Check please</div>
                <label for="total_sum">Sum:</label>
                <input type="number" step="0.01" name="total_sum" id="total_sum">
                {{ csrf_field() }}
                <input type="hidden" name="currency">
                <input type="submit">
            </form>
            <button id="exit_modal">Exit</button>
        </div>

@endsection