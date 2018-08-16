@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Category Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>Category Slug</td>
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
                    <td>Parent Category</td>
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
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Category!',
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
            <a class="btn" href="{{ route('admin.category.index') }}">Cancel</a>
        </div>
    </div>

@stop