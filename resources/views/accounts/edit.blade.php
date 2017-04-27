@extends('base')

@section('content')
    <form action="/account/update/{{$account->id}}" method="post" class="account_edit">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required value="{{ $account->title }}">
        <label for="total_sum">Sum:</label>
        <input type="number" step="0.01" id="total_sum" required name="total_sum" value="{{ $account->total_sum }}">
        <label for="currency">Currency:</label>
        <select name="currency" id="currency">
            @foreach($currencies as $currency)
                <option value="{{ $currency->cc }}" @if($currency->cc === $account->currency) selected @endif>{{
                                    $currency->txt
                                    }}</option>
            @endforeach
        </select>        
        <div class="add_img">
            <img src="{{ asset($account->pic) }}" alt="">
            Change image
        </div>
        <div class="images">
            <ul>
                @foreach(glob('images/accounts_icons/*.png') as $img)
                    <li><img src="{{ asset($img) }}" alt=""></li>
                @endforeach
            </ul>
        </div>
        <input type="hidden" name="pic" value="{{ $account->pic }}">
        {{ csrf_field() }}
        <input type="submit">
    </form>

    <script src="{{ asset('js/edit.js') }}" charset="utf-8"></script>
@endsection