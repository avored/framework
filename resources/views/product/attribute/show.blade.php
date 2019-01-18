@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Attribute Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>{{ __('avored-framework::lang.name') }}</td>
                    <td>{{ $attribute->name }}</td>
                </tr>

                <tr>
                    <td>Identifier</td>
                    <td>{{ $attribute->identifier }}</td>
                </tr>

                @if($attribute->attributeDropdownOptions->count() >= 0)
                <tr>
                    <td>Dropdown Options</td>

                    <td>
                        <ul>
                        @foreach($attribute->attributeDropdownOptions as $option)
                            <li>{{ $option->display_text }}</li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
                @endif
            </table>

            <div class="float-left">

                <form method="post" action="{{ route('admin.attribute.destroy', $attribute->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault();
                                    swal({
                                        dangerMode: true,
                                        title: '{{ __('avored-framework::lang.are-you-sure') }}',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Attribute!',
                                    }).then((willDelete) => {
                                        if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                        }
                                    });"
                        class="btn btn-danger" >
                        Destroy
                    </button>
                </form>

            </div>
            <a class="btn" href="{{ route('admin.attribute.index') }}">{{ __('avored-framework::lang.cancel') }}</a>
        </div>
    </div>

@stop
