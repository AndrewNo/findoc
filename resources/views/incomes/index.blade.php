@extends('base')

@section('content')
    <div class="callendar">
        <input type="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" name="date">
        <a href="/incomes"><i class="fa fa-repeat" aria-hidden="true"></i></a>
    </div>

    <div class="new_account">
        <p>Add new income</p>
        <div id="add_account_modal">
            <div id="show-modal"><i class="fa fa-plus" aria-hidden="true"></i></div>
        </div>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <h3>New Income</h3>
                    </div>

                    <div class="modal-body">
                        <form action="income/add" method="post">
                            <label for="account">Account</label>
                            <input type="text" id="account_search">
                            <select name="account_id" id="account" size="5">
                                <option value="" disabled="disabled" selected>Choose account</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}"
                                            data-currency="{{ $account->currency }}">{{ $account->title }}</option>
                                @endforeach
                            </select>
                            <label for="total_sum">Sum:</label>
                            <input type="number" step="0.01" id="total_sum" required name="total_sum"><span></span>
                            <label for="category_id">Category:</label>
                            <input type="text" id="category_search">
                            <select name="category_id" id="category_id" size="5">
                                <option value="" disabled="disabled" selected>Choose category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            data-category-pic="{{ $category->pic }}">{{ $category->title }}</option>
                                @endforeach

                            </select>
                            <div class="add_category" title="Add category">
                                <img src="" alt="" id="img_category">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </div>
                            <label for="payer_id">Payer:</label>
                            <input type="text" id="payer_search">
                            <select name="payer_id" id="payer_id" size="5">
                                <option value="" disabled="disabled" selected>Choose payer</option>
                                @foreach($payers as $payer)
                                    <option value="{{ $payer->id }}">{{ $payer->title }}</option>
                                @endforeach
                            </select>
                            <div class="add_payer" title="Add payer">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </div>
                            <label for="comment">Comment</label>
                            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>


                            <input type="hidden" name="currency">
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
                                        <li><img src="/{{ $img }}" alt=""></li>
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
    </div>

    <div class="active_accounts">
        <h3>Incomes per day:</h3>
        <table class="account">
            @if($incomes->count() != 0)
                <tr>
                    <th>Category</th>
                    <th>Account</th>
                    <th>Sum</th>
                    <th>Currency</th>
                    <th>Payer</th>
                    <th>Comment</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($incomes as $income)

                <tr>
                    <td class="category"><img src="{{ asset($income->category->pic) }}" alt="">{{ $income->category->title }}</td>
                    <td>{{ $income->account->title }}</td>
                    <td class="account_sum">
                        {{ $income->total_sum }}
                    </td>
                    <td>{{ $income->currency }}</td>
                    <td>
                        @if($income->payer_id != null)
                            {{ $income->payer->title }}
                        @endif
                    </td>
                    <td>{{ $income->comment }}</td>
                    <td class="edit">
                        <button><a href="income/{{ $income->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </button>
                    </td>
                    <td class="delete">
                        <form action="income/destroy/{{ $income->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}

                            <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
    <script src="{{ asset('js/income_add.js') }}"></script>
@endsection