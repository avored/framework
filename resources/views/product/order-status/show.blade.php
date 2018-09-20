@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Order Status Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $orderStatus->name }}</td>
                </tr>
               
                <tr>
                    <td>Is Active</td>
                    <td>{{ (1 === $orderStatus->is_default) ? "Yes" : "No" }}</td>
                </tr>
            </table>

            <div class="float-left">
                
              
                <form method="post" action="{{ route('admin.order-status.destroy', $orderStatus->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Order Status!',
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
            <a class="btn" href="{{ route('admin.order-status.index') }}">Cancel</a>
        </div>
    </div>

@stop