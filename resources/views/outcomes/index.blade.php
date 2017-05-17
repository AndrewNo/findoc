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
                <form action="outcome/add" method="post">
                    <label for="account_id">Account:</label>
                    <select name="account_id" id="account_id">
                        <option value="" disabled selected>Choose account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}"
                                    data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                        @endforeach
                    </select>
                    <label for="total_sum">Sum:</label>
                    <input type="number" name="total_sum" id="total_sum">
                    <span></span>
                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id">
                        <option value="" disabled selected>Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" data-img="{{ $category->pic }}">{{ $category->title
                            }}</option>
                        @endforeach
                    </select>
                    <div class="add_category" title="New category">
                        <img src="https://cdn.pixabay.com/photo/2015/11/03/09/03/question-mark-1019993_960_720.jpg"
                             alt="" id="img_category">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                    <div class="subcategory_block">
                        <label for="subcategory_id">Subcategory:</label>
                        <select name="subcategory_id" id="subcategory_id">
                            <option value="" disabled selected>Choose subcategory</option>
                        </select>
                        <div class="add_subcategory" title="New subcategory">
                            <img src="https://cdn.pixabay.com/photo/2015/11/03/09/03/question-mark-1019993_960_720.jpg"
                                 alt="" id="img_subcategory">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
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
                <button id="exit_add_outcome">Exit</button>
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
                <button id="category_add_exit">Exit</button>
            </div>
            <div class="subcategory_add_new">
                <h3>New subcategory</h3>
                <form action="">
                    <label for="subcategory_title">Title:</label>
                    <input type="text" name="subcategory_title" id="subcategory_title">
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
                    <input type="hidden" name="category_id" value="">
                    <input type="hidden" name="pic">
                    <input type="submit">
                </form>
                <button id="subcategory_add_exit">Exit</button>
            </div>
            <div class="seller_add_new">
                <h3>New seller</h3>
                <form action="">
                    <label for="seller_title">Title:</label>
                    <input type="text" name="seller_title" id="seller_title">
                    {{ csrf_field() }}
                    <input type="submit">
                </form>
                <button id="seller_add_exit">Exit</button>
            </div>

        </div>
    </div>

    <div class="active_accounts">
        <h3>Incomes per day:</h3>
        <table class="account">
            @if($outcomes->count() != 0)
                <tr>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Account</th>
                    <th>Sum</th>
                    <th>Currency</th>
                    <th>Seller</th>
                    <th>Comment</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($outcomes as $outcome)

                <tr>
                    <td><img src="{{ asset($outcome->category->pic) }}" alt="">
                        {{ $outcome->category->title }} ->
                    </td>
                    <td>@if($outcome->subcategory_id != null)<img src="{{ asset($outcome->subcategory->pic) }}" alt="">
                        {{ $outcome->subcategory->title }}
                        @endif
                    </td>
                    <td>{{ $outcome->category->title }}</td>
                    <td class="account_sum">
                        {{ $outcome->total_sum }}
                    </td>
                    <td>{{ $outcome->currency }}</td>
                    <td>
                        @if($outcome->seller_id != null)
                            {{ $outcome->seller->title }}
                        @endif
                    </td>
                    <td>{{ $outcome->comment }}</td>
                    <td class="edit">
                        <button><a href="outcome/{{ $outcome->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </button>
                    </td>
                    <td class="delete">
                        <form action="outcome/destroy/{{ $outcome->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
    <script src="{{ asset('js/outcome_add.js') }}"></script>
@endsection