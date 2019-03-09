@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-framework::attribute.edit') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.attribute.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')

                        <attribute-field-page inline-template :model="{{ $model }}">
                                <div>
                                    @include('avored-framework::product.attribute._fields')
                                </div>
                            </attribute-field-page>
                        
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::attribute.edit') }}
                            </button>
                            <a href="{{ route('admin.attribute.index') }}" 
                                    class="btn">
                                    {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
