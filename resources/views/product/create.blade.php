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

                        @include("avored-framework::forms.text",['name'=> 'name','label' => 'Name'])
                        @include("avored-framework::forms.select",['name'=> 'type','label' => 'Type',
                                                                    'options' => ['BASIC' => 'Basic Product',
                                                                                    'VARIATION' => 'Variable Product',
                                                                                    'DOWNLOADABLE' => 'Downloadable Product'
                                                                                ]
                                                                    ])


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create & Continue</button>
                            <button type="button"
                                    onclick="location='{{ route('admin.product.index') }}'"

                                    class="btn">Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection