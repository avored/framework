@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-framework::role.role-create') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.role.store') }}" method="post">
                        {{ csrf_field() }}

                        @include('avored-framework::system.role._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('avored-framework::role.role-create') }}</button>
                            <a href="{{ route('admin.role.index') }}" class="btn">{{ __('avored-framework::lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection