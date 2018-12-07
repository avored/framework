@extends('avored-framework::layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    {{ __("avored-framework::lang.product.create.text") }}
                </div>
                <div class="card-body">
                    <form
                            id="product-save-form"
                            action="{{ route('admin.product.store') }}"
                            method="post"
                            enctype="multipart/form-data">

                        @csrf

                        @include("avored-framework::forms.text",['name'=> 'name','label' => __('avored-framework::product.name')])
                        @include("avored-framework::forms.select",['name'=> 'type','label' =>  __('avored-framework::product.type_name'),
                                                                    'options' => ['BASIC' => __('avored-framework::product.type.basic'),
                                                                                    'VARIATION' => __('avored-framework::product.type.variable'),
                                                                                    'DOWNLOADABLE' => __('avored-framework::product.type.downloadable')
                                                                                ]
                                                                    ])


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cadastrar & Continuar</button>
                            <button type="button"
                                    onclick="location='{{ route('admin.product.index') }}'"

                                    class="btn">Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection