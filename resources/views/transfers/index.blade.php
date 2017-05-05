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
            <form action="transfer/add" method="post">
                <label for="account_from">From account:</label>
                <select name="account_from" id="account_from">
                    <option value="" selected disabled="">Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}" data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <span class="currency_from"></span>
                <span><i class="fa fa-exchange" aria-hidden="true"></i></span>
                <label for="account_to">To account:</label>
                <select name="account_to" id="account_to">
                    <option value="" disabled selected>Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}" data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <span class="currency_to"></span>
                <span class="refresh"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                <div class="warning">Different accounts! Check please</div>
                <label for="total_sum">Sum:</label>
                <input type="number" step="0.01" name="total_sum" id="total_sum">
                {{ csrf_field() }}
                <input type="hidden" name = "currency">
                <input type="submit">
            </form>
            <button id="exit_modal">Exit</button>
        </div>
    </div>
    <div class="active_accounts">
        <h3>Incomes per day:</h3>
        <table class="account">
            @if($transfers->count() != 0)
                <tr>
                    <th>Pic</th>
                    <th>Account from</th>
                    <th>Pic</th>
                    <th>Account to</th>
                    <th>Sum</th>
                    <th>Currency</th>

                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($transfers as $transfer)

                <tr>
                    <td><img src="{{ asset($transfer->account_from_detail->pic) }}" alt=""></td>
                    <td>{{ $transfer->account_from_detail->title }} =></td>
                    <td><img src="{{ asset($transfer->account_to_detail->pic) }}" alt=""></td>
                    <td>{{ $transfer->account_to_detail->title }}</td>
                    <td class="account_sum">
                        {{ $transfer->total_sum }}
                    </td>
                    <td>{{ $transfer->currency }}</td>

                    <td class="edit">
                        <button><a href="transfer/{{ $transfer->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </button>
                    </td>
                    <td class="delete">
                        <form action="transfer/destroy/{{ $transfer->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
    <script src="{{ asset('js/transfer.js') }}"></script>
@endsection