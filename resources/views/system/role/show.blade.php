@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Role Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $role->name }}</td>
                </tr>
                
                
                <tr>
                    <td>Desctiption</td>
                    <td>{{ $role->descriptoon }}</td>
                </tr>
                
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.role.destroy', $role->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Role!',
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
            <a class="btn" href="{{ route('admin.role.index') }}">Cancel</a>
        </div>
    </div>

@stop