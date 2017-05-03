@extends('base')

@section('content')
    <form action="outcome/update/{{ $outcome->id }}" method="post">
        <label for="account_id">Account:</label>
        <select name="account_id" id="account_id">
            <option value="" disabled selected>Choose account</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" data-currency="{{ $account->currency }}"
                        @if($account->id == $outcome->account_id) selected @endif>{{ $account->title
                }}</option>
            @endforeach
        </select>
        <label for="total_sum">Sum:</label>
        <input type="number" name="total_sum" id="total_sum" value="{{ $outcome->total_sum }}">
        <span>{{ $outcome->currency }}</span>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id">
            <option value="" disabled selected>Choose category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" data-img="{{ $category->pic }}"
                        @if($category->id == $outcome->category_id) selected @endif >{{
                $category->title
                            }}</option>
            @endforeach
        </select>
        <div class="add_category" title="New category">
            <img src="" alt="" id="img_category">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        <div class="subcategory_block">
            <label for="subcategory_id">Subcategory:</label>
            <select name="subcategory_id" id="subcategory_id">
                <option value="" disabled selected>Choose subcategory</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" data-img="{{ $subcategory->pic }}"
                            @if($subcategory->id == $outcome->subcategory_id) selected @endif >{{
                $subcategory->title
                            }}</option>
                @endforeach
            </select>
            <div class="add_subcategory" title="New subcategory">
                <img src="" alt="" id="img_subcategory">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
        </div>

        <label for="seller_id">Seller:</label>
        <select name="seller_id" id="seller_id">
            <option value="" disabled selected>Choose seller</option>
            @foreach($sellers as $seller)
                <option value="{{ $seller->id }}" @if($seller->id == $outcome->seller_id) selected @endif >{{ $seller->title }}</option>
            @endforeach
        </select>
        <div class="add_seller" title="New seller">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="10">{{$outcome->comment}}</textarea>
        {{ csrf_field() }}
        <input type="hidden" name="currency">
        <input type="submit">
    </form>
@endsection