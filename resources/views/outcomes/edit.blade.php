@extends('base')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/outcomes_edit.css') }}">
@endsection

@section('content')
    <form action="/outcome/update/{{ $outcome->id }}" method="post">
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

            @if($outcome->category_id != null)

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" data-img="{{ $category->pic }}"
                            @if($category->id == $outcome->category_id) selected @endif >{{
                $category->title
                            }}</option>
                @endforeach
            @else

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" data-img="{{ $category->pic }}">{{$category->title}}</option>
                @endforeach
            @endif
        </select>
        <div class="add_category" title="New category">
            @if($outcome->category_id != null)
                <img src="{{ asset($outcome->category->pic) }}" alt="" id="img_category">
            @endif
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>

        <div class="subcategory_block">
            <label for="subcategory_id">Subcategory:</label>
            <select name="subcategory_id" id="subcategory_id">
                <option value="" disabled selected>Choose subcategory</option>
                @if($outcome->subcategory_id != null)
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" data-img="{{ $subcategory->pic }}"
                                @if($subcategory->id == $outcome->subcategory_id) selected @endif >{{
                $subcategory->title
                            }}</option>
                    @endforeach
                @else
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" data-img="{{ $subcategory->pic }}">{{
                $subcategory->title
                            }}</option>
                    @endforeach
                @endif

            </select>
            <div class="add_subcategory" title="New subcategory">
                <img @if($category->subcategory_id != null)src="{{ asset($outcome->subcategory->pic) }}" @endif alt=""
                     id="img_subcategory">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
        </div>

        <label for="seller_id">Seller:</label>
        <select name="seller_id" id="seller_id">
            <option value="" disabled selected>Choose seller</option>
            @foreach($sellers as $seller)
                <option value="{{ $seller->id }}"
                        @if($seller->id == $outcome->seller_id) selected @endif >{{ $seller->title }}</option>
            @endforeach
        </select>
        <div class="add_seller" title="New seller">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="10">{{$outcome->comment}}</textarea>
        {{ csrf_field() }}
        <input type="hidden" name="currency" value="{{ $outcome->currency }}">
        <input type="submit">
    </form>
    <div class="modal_bg">
        <div class="modal_container">
            <div class="add_new_category">
                <h3>Add new category:</h3>
                <form action="">
                    <label for="new_category_title">Title:</label>
                    <input type="text" name="category_title" id="new_category_title">
                    <div id="add_image">
                        Add image
                    </div>
                    <div class="images">
                        <ul>
                            @foreach(glob('images/accounts_icons/*.png') as $img)
                                <li><img src="/{{ $img }}" alt=""></li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" name="pic">
                    <input type="hidden" name="type" value="outcome">
                    <input type="submit">
                </form>
                <button id="category_exit">Exit</button>
            </div>
            <div class="add_new_subcategory">
                <h3>Add new subcategory:</h3>
                <form action="">
                    <label for="new_subcategory_title">Title:</label>
                    <input type="text" name="subcategory_title" id="new_subcategory_title">
                    <div id="add_image_subcategory">
                        Add image
                    </div>
                    <div class="images">
                        <ul>
                            @foreach(glob('images/accounts_icons/*.png') as $img)
                                <li><img src="/{{ $img }}" alt=""></li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" name="pic">
                    <input type="submit">
                </form>
                <button id="subcategory_exit">Exit</button>
            </div>
            <div class="add_new_seller">
                <h3>Add new seller:</h3>
                <form action="">
                    <label for="new_seller_title">Title:</label>
                    <input type="text" name="seller_title" id="new_seller_title">
                    <input type="submit">
                </form>
                <button id="seller_exit">Exit</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/outcome_edit.js') }}"></script>
@endsection