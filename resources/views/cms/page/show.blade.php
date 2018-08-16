@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Page Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $page->name }}</td>
                </tr>
                
                <tr>
                    <td>Slug</td>
                    <td>{{ $page->slug }}</td>
                </tr>
                
                <tr>
                    <td>Meta Title</td>
                    <td>{{ $page->meta_title }}</td>
                </tr>
                
                <tr>
                    <td>Meta Description</td>
                    <td>{{ $page->meta_description }}</td>
                </tr>
            
                
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.page.destroy', $page->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Page!',
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
            <a class="btn" href="{{ route('admin.page.index') }}">Cancel</a>
        </div>
    </div>

@stop