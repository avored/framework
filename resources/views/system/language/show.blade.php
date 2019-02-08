@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('avored-framework::system.language.title') }}
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>{{ __('avored-framework::system.language.name') }}</td>
                    <td>{{ $language->name }}</td>
                </tr>
                <tr>
                    <td>{{ __('avored-framework::system.language.code') }}</td>
                    <td>{{ $language->code }}</td>
                </tr>
               
                <tr>
                    <td>{{ __('avored-framework::system.language.is_default') }}</td>
                    <td>{{ (1 === $language->is_default) ? "Yes" : "No" }}</td>
                </tr>
            </table>

            <div class="float-left">
                
              
                <form method="post" action="{{ route('admin.language.destroy', $language->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: '{{ __('avored-framework::system.language.delete_title') }}',
                                        icon: 'warning',
                                        buttons: true,
                                        text: '{{ __('avored-framework::system.language.delete_warning') }}',
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
            <a class="btn" href="{{ route('admin.language.index') }}">
                {{ __('avored-framework::lang.cancel') }}
            </a>
        </div>
    </div>

@stop
