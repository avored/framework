@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Site Currency Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $siteCurrency->name }}</td>
                </tr>
                
                <tr>
                    <td>Curreny Code</td>
                    <td>{{ $siteCurrency->curreny_code }}</td>
                </tr>
                
                <tr>
                    <td>Conversion Rate</td>
                    <td>{{ $siteCurrency->conversion_rate }}</td>
                </tr>
                
                <tr>
                    <td>Status</td>
                    <td>{{ $siteCurrency->status }}</td>
                </tr>
                

                
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.site-currency.destroy', $siteCurrency->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Site Currency!',
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
            <a class="btn" href="{{ route('admin.site-currency.index') }}">Cancel</a>
        </div>
    </div>

@stop