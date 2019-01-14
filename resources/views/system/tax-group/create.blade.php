@extends('avored-framework::layouts.app')

@section('content')

    <div id="admin-tax-group-page" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.tax-group.create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.tax-group.store') }}" method="post">
                        @csrf

                        @include('avored-framework::system.tax-group._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.tax-group.create') }}
                            </button>
                            <a href="{{ route('admin.tax-group.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
