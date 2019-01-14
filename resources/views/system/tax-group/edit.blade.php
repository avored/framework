@extends('avored-framework::layouts.app')

@section('content')

    <div id=admin-admin-state-page class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.tax-group.update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tax-group.update', $model->id) }}" 
                      
                        method="post">
                        @csrf()
                        @method('put')

                        @include('avored-framework::system.tax-group._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.tax-group.update') }}
                            </button>
                            <a href="{{ route('admin.tax-group.index') }}" class="btn">
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