@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-framework::user.user-create') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="post">
                        @csrf()

                        @include('avored-framework::user.user._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::user.user-create') }}
                            </button>

                            <a href="{{ route('admin.user.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection