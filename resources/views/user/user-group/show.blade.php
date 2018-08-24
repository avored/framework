@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            User Group Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $userGroup->name }}</td>
                </tr>
                
                
                <tr>
                    <td>Is Default</td>
                    <td>{{ $userGroup->is_default }}</td>
                </tr>
                
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.user-group.destroy', $userGroup->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this User Group!',
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
            <a class="btn" href="{{ route('admin.user-group.index') }}">Cancel</a>
        </div>
    </div>

@stop