@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Property Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $property->name }}</td>
                </tr>
                
                <tr>
                    <td>Identifier</td>
                    <td>{{ $property->identifier }}</td>
                </tr>
                
                <tr>
                    <td>Used In All Products</td>
                    <td>{{ ($property->use_for_all_products == 1) ? "Yes" : "No" }}</td>
                </tr>
                
                <tr>
                    <td>Data Type</td>
                    <td>{{ $property->data_type }}</td>
                </tr>
                
                <tr>
                    <td>Field Type</td>
                    <td>{{ $property->field_type }}</td>
                </tr>
                
                <tr>
                    <td>Sort Order</td>
                    <td>{{ $property->sort_order }}</td>
                </tr>
                
               
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.property.destroy', $property->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Property!',
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
            <a class="btn" href="{{ route('admin.property.index') }}">Cancel</a>
        </div>
    </div>

@stop