@if($transfers->count() != 0)
    <tr>
        <th>Pic</th>
        <th>Account from</th>
        <th>Pic</th>
        <th>Account to</th>
        <th>Sum</th>
        <th>Currency</th>

        <th>Edit</th>
        <th>Delete</th>
    </tr>
@endif
@foreach($transfers as $transfer)

    <tr>
        <td><img src="{{ asset($transfer->account_from_detail->pic) }}" alt=""></td>
        <td>{{ $transfer->account_from_detail->title }} =></td>
        <td><img src="{{ asset($transfer->account_to_detail->pic) }}" alt=""></td>
        <td>{{ $transfer->account_to_detail->title }}</td>
        <td class="account_sum">
            {{ $transfer->total_sum }}
        </td>
        <td>{{ $transfer->currency }}</td>

        <td class="edit">
            <button><a href="transfer/{{ $transfer->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </button>
        </td>
        <td class="delete">
            <form action="transfer/destroy/{{ $transfer->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('delete') }}

                <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </form>
        </td>
    </tr>

@endforeach