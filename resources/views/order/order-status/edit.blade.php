@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::shop.order-status-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.order-status.update', $model->id) }}" method="post">
                        <order-status-field-page inline-template :model="{{ $model }}">
                            <div>
                        @csrf()
                        @method('put')

                        @include('avored-framework::order.order-status._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::shop.order-status-update') }}
                            </button>
                            <a href="{{ route('admin.order-status.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>
                        </div>
                        </order-status-field-page>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
