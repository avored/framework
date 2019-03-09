@extends('avored-framework::layouts.app')

@section('content')

    <div  class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.site-currency.update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.site-currency.update', $model->id) }}" 
                        
                        method="post">
                        @csrf()
                        @method('put')

                        <site-currency-field-page inline-template :model="{{ $model }}">
                            <div>
                                @include('avored-framework::system.site-currency._fields')
                            </div>
                        </site-currency-field-page>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.site-currency.update') }}
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
