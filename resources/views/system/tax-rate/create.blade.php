@extends('avored-framework::layouts.app')

@section('content')

    <div id="admin-tax-rate-page" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.tax-rate.create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.tax-rate.store') }}" method="post">
                        @csrf

                        @include('avored-framework::system.tax-rate._fields')

                        <div class="form-rate">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.tax-rate.create') }}
                            </button>
                            <a href="{{ route('admin.tax-rate.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
