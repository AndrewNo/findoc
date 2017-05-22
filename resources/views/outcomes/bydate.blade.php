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