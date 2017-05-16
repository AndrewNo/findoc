@extends('base')
@section('links')
@endsection

@section('content')
    <h3>SubCategories</h3>
    <div class="active_accounts">
        <table class="account">
            @if(\App\Models\Subcategory::all()->count() != 0)
                <tr>
                    <th>Pic</th>
                    <th>Category</th>
                    <th>Pic</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($subcategories as $subcategory)
                <tr>
                    <td><img src="{{ asset($subcategory->category->pic) }}" alt=""></td>
                    <td>{{ $subcategory->category->title }}</td>
                    <td><img src="{{ asset($subcategory->pic) }}" alt=""></td>
                    <td>{{ $subcategory->title }}</td>
                    <td class="edit">
                        <button><a href="subcategory/{{ $subcategory->id }}"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i></a>
                        </button>
                    </td>
                    <td class="delete">
                        <form action="/subcategory/destroy/{{ $subcategory->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection