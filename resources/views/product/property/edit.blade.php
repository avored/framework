@extends('avored-framework::layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-framework::property.edit') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.property.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')

                        @include('avored-framework::product.property._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::property.edit') }}
                            </button>
                            <a href="{{ route('admin.property.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection