@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.site-currency.create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.site-currency.store') }}" method="post">
                        @csrf
                        <site-currency-field-page inline-template>
                            <div>
                                @include('avored-framework::system.site-currency._fields')
                            </div>
                        </site-currency-field-page>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.site-currency.create') }}
                            </button>
                            <a href="{{ route('admin.site-currency.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
