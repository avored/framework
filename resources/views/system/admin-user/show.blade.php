@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Account Details
            
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>First Name</td>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
                <tr>
                    <td>Is Super Admin</td>
                    <td>{{ (1 === $user->is_super_admin) ? "Yes" : "No" }}</td>
                </tr>
            </table>

            <div class="float-left">
                
                @if($user->is_super_admin === 1)
                <button class="btn btn-danger" disabled >
                    Destroy
                </button>
                @else
                <form method="post" action="{{ route('admin.admin-user.destroy', $user->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this AdminUser!',
                                    }).then((willDelete) => {
                                        if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                        }
                                    });"    
                        class="btn btn-danger" >
                        Destroy
                    </button>
                </form>
                @endif
            </div>
            <a class="btn" href="{{ route('admin.admin-user.index') }}">Cancel</a>
        </div>
    </div>

@stop