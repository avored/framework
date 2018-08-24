@extends('avored-framework::layouts.app')

@section('content')

    <div id=admin-admin-state-page class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.state-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.state.update', $model->id) }}" 
                      
                        method="post">
                        @csrf()
                        @method('put')

                        @include('avored-framework::system.state._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.state-update') }}
                            </button>
                            <a href="{{ route('admin.state.index') }}" class="btn">
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