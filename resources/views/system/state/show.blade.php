@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Country Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $state->name }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>{{ $state->code }}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{ $state->country->name }}</td>
                </tr>
                
            </table>

            <div class="float-left">
                
              
                <form method="post" action="{{ route('admin.state.destroy', $state->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this State!',
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
            <a class="btn" href="{{ route('admin.state.index') }}">Cancel</a>
        </div>
    </div>

@stop