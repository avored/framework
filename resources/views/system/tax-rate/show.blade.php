@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Tax Rate Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $taxRate->name }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $taxRate->description }}</td>
                </tr>
                <tr>
                    <td>Rate</td>
                    <td>{{ $taxRate->rate }}</td>
                </tr>
                <tr>
                    <td>Rate Type</td>
                    <td>{{ $taxRate->rate_type }}</td>
                </tr>
                <tr>
                    <td>Rate Applied via</td>
                    <td>{{ $taxRate->applied_with }}</td>
                </tr>
            </table>

            <div class="float-left">
                
              
                <form method="post" action="{{ route('admin.tax-rate.destroy', $taxRate->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this tax rate!',
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
            <a class="btn" href="{{ route('admin.tax-rate.index') }}">Cancel</a>
        </div>
    </div>

@stop
