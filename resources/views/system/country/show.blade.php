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
                    <td>{{ $country->name }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>{{ $country->code }}</td>
                </tr>
                <tr>
                    <td>Phone Code</td>
                    <td>{{ $country->phone_code }}</td>
                </tr>
                <tr>
                    <td>Lang Code</td>
                    <td>{{ $country->lang_code }}</td>
                </tr>
                <tr>
                    <td>Is Active</td>
                    <td>{{ (1 === $country->is_active) ? "Yes" : "No" }}</td>
                </tr>
            </table>

            <div class="float-left">
                
              
                <form method="post" action="{{ route('admin.country.destroy', $country->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Country!',
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
            <a class="btn" href="{{ route('admin.country.index') }}">Cancel</a>
        </div>
    </div>

@stop