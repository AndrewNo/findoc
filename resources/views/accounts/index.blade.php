@extends('base')

@section('content')

    <div class="new_account">
        <p>Add new account</p>
        <div id="add_account_modal">
            <div id="show-modal"><i class="fa fa-plus" aria-hidden="true"></i></div>
        </div>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <h3>New Account</h3>
                    </div>

                    <div class="modal-body">
                        <form action="account/add" method="post">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" required>
                            <label for="total_sum">Sum:</label>
                            <input type="number" step="0.01" id="total_sum" required name="total_sum">
                            <label for="currency">Currency:</label>
                            <select name="currency" id="currency">
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->cc }}" @if($currency->cc === 'UAH') selected @endif>{{
                                    $currency->txt
                                    }}</option>
                                @endforeach
                            </select>
                            <div class="add_img">
                                Add image
                            </div>
                            <div class="images">
                                <ul>
                                    @foreach(glob('images/accounts_icons/*.png') as $img)
                                        <li><img src="{{ $img }}" alt=""></li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="hidden" name="pic">
                            {{ csrf_field() }}
                            <input type="submit">
                        </form>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            Exit
                            <button class="modal-default-button">
                                Cancel
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="active_accounts">
        <h3>Active accounts:</h3>
        <table class="account">
            <tr>
                <th>#</th>
                <th>Pic</th>
                <th>Title</th>
                <th>Sum</th>
                <th>Currency</th>
            </tr>

        @foreach($accounts as $account)
            @if($account->is_active == true)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ $account->pic }}" alt=""></td>
                        <td>{{ $account->title }}</td>
                        <td>{{ $account->total_sum }}</td>
                        <td>{{ $account->currency }}</td>
                    </tr>
            @endif
        @endforeach
        </table>
    </div>

    <div class="inactive_accounts">
        <h3>Inactive accounts:</h3>
    </div>


    <script src="{{ asset('js/main.js') }}" charset="utf-8"></script>
@endsection