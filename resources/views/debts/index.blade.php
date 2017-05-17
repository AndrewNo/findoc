@extends('base')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/debts.css') }}">
@endsection

@section('content')
    <h3>Add new debt</h3>
    <div class="add_debt">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </div>
    <div class="modal_bg">
        <div class="modal_container">
            <h3>New debt</h3>
            <form action="debt/add" method="post">
                <label for="account">Account:</label>
                <select name="account_id" id="account">
                    <option value="" selected disabled>Choose account</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }} "
                                data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                    @endforeach
                </select>
                <label for="total_sum">Sum:</label>
                <input type="number" step="0.01" name="total_sum" id="total_sum">
                <span class="currency"></span>
                <label for="type">Type:</label>
                <select name="type" id="type">
                    <option value="" selected disabled>Choose type</option>
                    <option value="debit">Debit</option>
                    <option value="credit">Credit</option>
                </select>
                <label for="agent">Contragent:</label>
                <select name="agent_id" id="agent">
                    <option value="" selected disabled>Choose agent</option>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->title }}</option>
                    @endforeach
                </select>
                <div class="add_agent">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
                <label for="comment">Comment:</label>
                <textarea name="comment" id="comment" cols="50" rows="5"></textarea>
                {{ csrf_field() }}
                <input type="hidden" name="currency">
                <input type="submit">
            </form>
            <button id="modal_exit">Exit</button>
        </div>
        <div class="modal_agent">
            <h3>New agent</h3>
            <form action="">
                <label for="title">Title:</label>
                <input type="text" name="title">
                {{ csrf_field() }}
                <input type="submit">
            </form>
            <button id="modal_agent_exit">Exit</button>
        </div>
    </div>

    <div class="active_accounts">
        <h3>Credit:</h3>
        <table class="account">
            @if(\App\Models\Debt::where('type', '=', 'credit')->count() != 0)
                <tr>
                    <th>Account</th>
                    <th>Sum</th>
                    <th>Currency</th>
                    <th>Credit to</th>
                    <th>Comment</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($debts as $debt)
                @if($debt->type == 'credit')
                    <tr>

                        <td>{{ $debt->account->title }}</td>
                        <td class="account_sum">
                            {{ $debt->total_sum }}
                        </td>
                        <td>{{ $debt->currency }}</td>
                        <td>
                            @if($debt->agent_id != null)
                                {{ $debt->agent->title }}
                            @endif
                        </td>
                        <td>{{ $debt->comment }}</td>
                        <td class="edit">
                            <button><a href="debt/{{ $debt->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </button>
                        </td>
                        <td class="delete">
                            <form action="/debt/destroy/{{ $debt->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>

    <div class="inactive_accounts">
        <h3>Debit:</h3>
        <table class="account">
            @if(\App\Models\Debt::where('type', '=', 'debit')->count() != 0)
                <tr>
                    <th>Account</th>
                    <th>Sum</th>
                    <th>Currency</th>
                    <th>Credit to</th>
                    <th>Comment</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($debts as $debt)
                @if($debt->type == 'debit')
                    <tr>

                        <td>{{ $debt->account->title }}</td>
                        <td class="account_sum">
                            {{ $debt->total_sum }}
                        </td>
                        <td>{{ $debt->currency }}</td>
                        <td>
                            @if($debt->agent_id != null)
                                {{ $debt->agent->title }}
                            @endif</td>
                        <td>{{ $debt->comment }}</td>
                        <td class="edit">
                            <button><a href="debt/{{ $debt->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </button>
                        </td>
                        <td class="delete">
                            <form action="/debt/destroy/{{ $debt->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <script src="{{ asset('js/debt.js') }}"></script>
@endsection