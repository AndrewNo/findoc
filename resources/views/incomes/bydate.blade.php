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