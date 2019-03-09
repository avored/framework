@extends('avored-framework::layouts.app')

@section('content')

        <div  class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('avored-framework::attribute.create') }}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.attribute.store') }}" method="post">
                            @csrf
                            <attribute-field-page inline-template>
                                <div>
                                    @include('avored-framework::product.attribute._fields')
                                </div>
                            </attribute-field-page>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('avored-framework::attribute.create') }}
                                </button>
                                <a href="{{ route('admin.attribute.index') }}" class="btn">
                                    {{ __('avored-framework::lang.cancel') }}
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
@endsection
