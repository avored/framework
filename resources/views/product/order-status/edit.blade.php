@extends('avored-framework::layouts.app')

@section('content')

    <div id=admin-admin-user-page class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::shop.order-status-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.order-status.update', $model->id) }}" 
                      
                        method="post">
                        @csrf()
                        @method('put')

                        @include('avored-framework::product.order-status._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::shop.order-status-update') }}
                            </button>
                            <a href="{{ route('admin.order-status.index') }}" class="btn">
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
        el: '#admin-admin-user-page',
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