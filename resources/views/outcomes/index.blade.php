@extends('base')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/outcomes.css') }}">
@endsection

@section('content')
    <h3>Add new outcome</h3>
    <div class="add_outcome">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </div>
    <div class="outcome_modal">
        <div class="outcome_modal_container">
            <div class="outcome_add_new">
                <h3>New outcome</h3>
                <form action="">
                    <label for="account_id">Account:</label>
                    <select name="account_id" id="account_id">
                        <option value="" disabled selected>Choose account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->title }}</option>
                        @endforeach
                    </select>
                    <label for="total_sum">Sum:</label>
                    <input type="number" name="total_sum" id="total_sum">
                    <span>KKK</span>
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id">
                        <option value="" disabled selected>Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <div class="add_category" title="New category">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <label for="subcategory_id">Subcategory:</label>
                    <select name="subcategory_id" id="subcategory_id">
                        <option value="" disabled selected>Choose subcategory</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                        @endforeach
                    </select>
                    <div class="add_subcategory" title="New subcategory">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <label for="seller_id">Seller:</label>
                    <select name="seller_id" id="seller_id">
                        <option value="" disabled selected>Choose seller</option>
                        @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}">{{ $seller->title }}</option>
                        @endforeach
                    </select>
                    <div class="add_seller" title="New seller">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                    {{ csrf_field() }}
                    <input type="hidden" name="currency">
                    <input type="submit">
                </form>
            </div>
            <div class="category_add_new">
                <h3>New category</h3>
                <form action="">
                    <label for="category_title">Title:</label>
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
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="outcome">
                    <input type="hidden" name="pic">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/outcome_add.js') }}"></script>
@endsection