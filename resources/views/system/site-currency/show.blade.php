@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Site Currency Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>{{ __('avored-framework::lang.name') }}</td>
                    <td>{{ $siteCurrency->name }}</td>
                </tr>

                <tr>
                    <td>Código da Moeda</td>
                    <td>{{ $siteCurrency->code }}</td>
                </tr>

                <tr>
                    <td>Taxa de Conversão</td>
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
                                        title: '{{ __('avored-framework::lang.are-you-sure') }}',
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
            <a class="btn" href="{{ route('admin.site-currency.index') }}">{{ __('avored-framework::lang.cancel') }}</a>
        </div>
    </div>

@stop
