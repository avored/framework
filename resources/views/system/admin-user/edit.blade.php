@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::user.admin-user-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admin-user.update', $model->id) }}" 
                        enctype="multipart/form-data" 
                        method="post">
                        @csrf()
                        @method('put')

                        <admin-user-field-page inline-template :model="{{ $model }}">
                            <div>
                                @include('avored-framework::system.admin-user._fields')
                            </div>
                        </admin-user-field-page>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::user.admin-user-update') }}
                            </button>
                            <a href="{{ route('admin.admin-user.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
