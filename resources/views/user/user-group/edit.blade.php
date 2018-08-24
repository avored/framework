@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-framework::user.user-group-edit') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.user-group.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')

                        @include('avored-framework::user.user-group._fields')

                        <div class="mt-3 form-group">
                            <button class="btn btn-primary"
                                    type="submit">{{ __('avored-framework::user.user-group-edit') }}</button>
                            <a href="{{ route('admin.user-group.index') }}"
                               class="btn">{{ __('avored-framework::lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection