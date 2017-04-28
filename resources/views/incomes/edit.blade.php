@extends('base')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/income_edit.css') }}">
@endsection
@section('content')
    <p>Change income</p>
    <form action="/income/update/{{ $income->id }}" method="post">
        <label for="account">Account</label>
        <select name="account_id" id="account">
            <option value="" disabled="disabled" selected>Choose account</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}"
                        data-currency="{{ $account->currency }}"
                        @if($account->id == $income->account_id) selected @endif>
                    {{ $account->title }}
                </option>
            @endforeach
        </select>
        <label for="total_sum">Sum:</label>
        <input type="number" step="0.01" id="total_sum" required name="total_sum"
               value="{{ $income->total_sum }}"><span>{{ $income->currency }}</span>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id">
            <option value="" disabled="disabled" selected>Choose category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        data-category-pic="{{ $category->pic }}"
                        @if($category->id == $income->category_id) selected @endif>
                    {{ $category->title }}
                </option>
            @endforeach

        </select>
        <div class="add_category" title="Add category">
            <img src="{{ asset($income->category->pic) }}" alt="" id="img_category">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        <label for="payer_id">Payer:</label>
        <select name="payer_id" id="payer_id">

            <option value="" disabled="disabled" selected>Choose payer</option>
            @foreach($payers as $payer)
                <option value="{{ $payer->id }}"
                        @if($payer->id == $income->payer_id) selected @endif>
                    {{ $payer->title }}
                </option>
            @endforeach

        </select>
        <div class="add_payer" title="Add payer">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        <label for="comment">Comment</label>
        <textarea name="comment" id="comment" cols="30" rows="10">{{ $income->comment }}</textarea>


        <input type="hidden" name="currency" value="{{ $income->currency }}">
        {{ csrf_field() }}
        <input type="submit">
    </form>

    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container modal-catgory">
                <div class="modal-header">
                    <h3>New category</h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="category_title">Title</label>
                        <input type="text" name="category_title" id="category_title">
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

                        <input type="hidden" name="pic" value="">
                        <input type="hidden" name="type" value="income">
                        {{ csrf_field() }}
                        <input type="submit">
                    </form>
                </div>

                <div class="modal-footer">

                    Exit
                    <button class="modal-default-button">
                        Cancel
                    </button>

                </div>
            </div>
            <div class="modal-container modal-payer">
                <div class="modal-header">
                    <h3>New payer</h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="payer_title">Title</label>
                        <input type="text" name="payer_title" id="payer_title"/>
                        {{ csrf_field() }}
                        <input type="submit">
                    </form>
                </div>

                <div class="modal-footer">

                    Exit
                    <button class="modal-default-button">
                        Cancel
                    </button>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/income_edit.js') }}"></script>
@endsection