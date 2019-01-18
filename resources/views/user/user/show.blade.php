@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header h4">
            {{ __('avored-framework::user.user-details') }}
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>{{ __('avored-framework::lang.name') }}</td>
                    <td>{{ $user->first_name }}</td>
                </tr>

                <tr>
                    <td>Sobrenome</td>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Telefone</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td>Empresa</td>
                    <td>{{ $user->company_name }}</td>
                </tr>
                @if($user->image_path)
                    <tr>
                        <td>Foto</td>
                        <td>
                            <img src="{{ $user->image_path->smallUrl }}"
                            class="img-fluid img"
                            />

                        </td>
                    </tr>
                @endif
                <tr>
                    <td>Idioma</td>
                    <td>{{ $user->language }}</td>
                </tr>
                <tr>
                    <td>Tax No</td>
                    <td>{{ $user->tax_no }}</td>
                </tr>

            </table>


            <div class="row">
                <div class="col-12">
                    <div class="h4">Pedidos</div>
                    <div class="user-orders-datagrid">
                        {!! DataGrid::render($userOrderDataGrid) !!}
                    </div>
                </div>
            </div>

            <div class="float-left">

                <a class="btn btn-warning" href="{{ route('admin.user.change-password', $user->id) }}">
                    Alterar Senha
                </a>

                <form method="post" class="d-inline" action="{{ route('admin.user.destroy', $user->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault();
                                    swal({
                                        dangerMode: true,
                                        title: '{{ __('avored-framework::lang.are-you-sure') }}',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this User!',
                                    }).then((willDelete) => {
                                        if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                        }
                                    });"
                        class="btn btn-danger" >
                        Excluir
                    </button>
                </form>

            </div>
            <a class="btn" href="{{ route('admin.user.index') }}">{{ __('avored-framework::lang.cancel') }}</a>
        </div>
    </div>

@stop
