@extends('base')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/debt_edit.css') }}">
@endsection

@section('content')

    <h3>Edit debt</h3>
    <form action="/debt/update/{{ $debt->id }}" method="post">
        <label for="account">Account:</label>
        <select name="account_id" id="account">
            <option value="" selected disabled>Choose account</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }} " data-currency = "{{ $account->currency }}"
                @if($account->id == $debt->account_id) selected @endif>{{ $account->title }}</option>
            @endforeach
        </select>
        <label for="total_sum">Sum:</label>
        <input type="number" step="0.01" name="total_sum" id="total_sum" value="{{ $debt->total_sum }}">
        <span class="currency">{{ $debt->currency }}</span>
        <label for="type">Type:</label>
        <select name="type" id="type">
            <option value="" selected disabled>Choose type</option>
            <option value="debit" @if($debt->type == 'debit') selected @endif>Debit</option>
            <option value="credit" @if($debt->type == 'credit') selected @endif>Credit</option>
        </select>
        <label for="agent">Contragent:</label>
        <select name="agent_id" id="agent">
            <option value="" selected disabled>Choose agent</option>
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}" @if($agent->id == $debt->agent_id) selected @endif>{{ $agent->title }}</option>
            @endforeach
        </select>
        <div class="add_agent">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" cols="50" rows="5">{{ $debt->comment }}</textarea>
        {{ csrf_field() }}
        <input type="hidden" name="currency" value="{{ $debt->currency }}">
        <input type="submit">
    </form>

    <div class="modal_bg">
        <div class="modal_agent">
            <h3>New agent</h3>
            <form action="">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title">
                {{ csrf_field() }}
                <input type="submit">
            </form>
            <button id="modal_agent_exit">Exit</button>
        </div>
    </div>
    <script src="{{ asset('js/debt_edit.js') }}"></script>
@endsection