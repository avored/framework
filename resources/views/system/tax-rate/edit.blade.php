@extends('avored-framework::layouts.app')

@section('content')

    <div id=admin-tax-rate-page class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.tax-rate.update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tax-rate.update', $model->id) }}" 
                      
                        method="post">
                        @csrf()
                        @method('put')

                        @include('avored-framework::system.tax-rate._fields')

                        <div class="form-rate">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.tax-rate.update') }}
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

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-admin-state-page',
        data : {
            model: {},
            autofocus:true,
            disabled: true
        },
        methods: {
            changeModelValue: function(val,fieldName) {
                this.model[fieldName] = val;
            }
        }
    });

</script>


@endpush
