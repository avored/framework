@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Categoria
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>{{ __('avored-framework::lang.name') }}</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>{{ __('avored-framework::product.category_name') }} Slug</td>
                    <td>{{ $category->slug }}</td>
                </tr>

                <tr>
                    <td>Meta Name</td>
                    <td>{{ $category->meta_name }}</td>
                </tr>

                <tr>
                    <td>Meta Description</td>
                    <td>{{ $category->meta_description }}</td>
                </tr>

                <tr>
                    <td>Parent {{ __('avored-framework::product.category_name') }}</td>
                    <td>{{ $category->parent_name }}</td>
                </tr>

            </table>

            <div class="float-left">

                <form method="post" action="{{ route('admin.category.destroy', $category->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault();
                                    swal({
                                        dangerMode: true,
                                        title: '{{ __('avored-framework::lang.are-you-sure') }}',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Category!',
                                    }).then((willDelete) => {
                                        if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                        }
                                    });"
                        class="btn btn-danger" >
                        Excluir
                    </button>
                </form>

            </div>
            <a class="btn" href="{{ route('admin.category.index') }}">{{ __('avored-framework::lang.cancel') }}</a>
        </div>
    </div>

@stop
