@extends('avored-framework::layouts.app')

@section('content')

    <div id="admin-site-currency-page" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::currency.update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.site-currency.update', $model->id) }}" 
                        
                        method="post">
                        @csrf()
                        @method('put')

                        @include('avored-framework::system.site-currency._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::currency.update') }}
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

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-site-currency-page',
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