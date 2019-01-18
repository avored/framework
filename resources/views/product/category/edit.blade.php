@extends('avored-framework::layouts.app')

@section('content')
<div id="admin-category-edit-page">
    <div class="row">
        <div class="col-12">
            <div class="h1 mt-1">Editar {{ __('avored-framework::product.category_name') }}</div>

            <form action="{{ route('admin.category.update', $model->id) }}" method="post">
                <div class="card mt-3 mb-3">
                    <div class="card-header">{{ __('avored-framework::lang.basic_details') }}</div>
                    <div class="card-body">

                        @csrf()
                        @method('put')
                        @include('avored-framework::product.category._fields')

                    </div>
                </div>

                <div class="card mt-3 mb-3">
                    <div class="card-header">SEO</div>
                    <div class="card-body">

                         <avored-form-input
                            field-name="meta_title"
                            label="Meta Name"
                            field-value="{!! $model->meta_title ?? "" !!}"
                            error-text="{!! $errors->first('meta_title') !!}"
                            v-on:change="changeModelValue"
                                >
                        </avored-form-input>

                        <avored-form-textarea
                            field-name="meta_description"
                            label="Meta Description"
                            field-value="{!! $model->meta_description ?? "" !!}"
                            error-text="{!! $errors->first('meta_description') !!}"
                            v-on:change="changeModelValue"
                                >
                        </avored-form-textarea>

                    </div>
                </div>

                <button type="submit"  class="btn n btn-primary  category-save-button">Editar {{ __('avored-framework::product.category_name') }}</button>

                <a href="{{ route('admin.category.index') }}" class="btn btn-default">{{ __('avored-framework::lang.cancel') }}</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>

 var app = new Vue({
        el: '#admin-category-edit-page',
        data : {
            category: {!! $model !!},
            autofocus: true
        },
        methods: {
            changeModelValue: function(val,fieldName) {
                this.category[fieldName] = val;
            }
        }
    });

</script>


@endpush
