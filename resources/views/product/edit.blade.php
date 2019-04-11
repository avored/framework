@extends('avored-framework::layouts.app')

@section('content')
<div id="admin-product-edit-page">
    <product-field-page :product="{{ $product }}" inline-template >
    <div>
        <div class="row">
            <div class="col-12">
                <div class="h1">Edit Product</div>
            </div>
        </div>
    
        <?php
        $productCategories = $product->categories()->get()->pluck('id')->toArray();
        ?>
        <form id="product-save-form"
              action="{{route('admin.product.update', $product->id)}}"
              enctype="multipart/form-data" method="post">
            @csrf
            @method('put')

            <div class="row" id="product-save-accordion" data-children=".product-card">
                <div class="col-12 mb-2 mt-2">
                    <div class="card product-card  mb-2 mt-2">
                        <a
                            v-on:click.prevent="changeCard('basic')"
                            data-parent="#product-save-accordion"
                            class="float-right" href="#basic"
                        >
                        <div class="card-header">
                            Basic Details
                        </div>
                        </a>

                    
                    
                        <div
                            :class="{ 'show': cards.basic, 'card-body collapse' : true}"
                            id="basic">
                            @include('avored-framework::product.card.basic')
                        </div>
                    </div>

                    <div class="card product-card mb-2 mt-2">
                        <a v-on:click.prevent="changeCard('images')"
                        class="float-right" href="#images">
                        <div class="card-header">
                            Images
                        </div>
                        </a>
                        <div :class="{ 'show': cards.images, 'card-body collapse' : true}" id="images">
                            @include('avored-framework::product.card.images')
                        </div>
                    </div>


                    <div class="card product-card mb-2 mt-2">
                        <a v-on:click.prevent="changeCard('seo')"
                        class="float-right" href="#seo">
                            <div class="card-header">SEO</div>
                        </a>
                        <div :class="{ 'show': cards.seo, 'card-body collapse' : true}" id="seo">
                            @include('avored-framework::product.card.seo')
                        </div>
                    </div>

                    <div class="card product-card mb-2 mt-2">
                        <a v-on:click.prevent="changeCard('property')"
                        class="float-right" href="#property">
                        <div class="card-header">
                            Property
                        </div>
                        </a>
                        <div :class="{ 'show': cards.property, 'card-body collapse' : true}" id="property">
                            @include('avored-framework::product.card.property')
                        </div>
                    </div>

                    @if($product->hasVariation())

                        <div class="card product-card mb-2 mt-2">
                            <a v-on:click.prevent="changeCard('attribute')"
                            class="float-right" href="#attribute">
                                <div class="card-header">
                                    Attribute
                                </div>
                            </a>
                            <div :class="{ 'show': cards.attribute, 'card-body collapse' : true}" id="attribute">
                                @include('avored-framework::product.card.attribute')
                            </div>
                        </div>

                    @endif

                    @if($product->type == "DOWNLOADABLE")

                    <div class="card product-card mb-2 mt-2">
                        <a v-on:click.prevent="changeCard('downloadable')"
                        class="float-right" href="#downloadable">
                            <div class="card-header ">
                                Downloadable Info
                            </div>
                        </a>
                        <div :class="{ 'show': cards.downloadable, 'card-body collapse' : true}" id="downloadable">
                            @include('avored-framework::product.card.downloadable')
                        </div>
                    </div>

                    @endif

                    @foreach(Tabs::all('product') as $key => $tab)

                        <div class="card product-card mb-2 mt-2">
                            <a v-on:click.prevent="changeCard('{{ $key }}')"
                            class="float-right" href="#{{ $key }}">
                            <div class="card-header">
                                {{ $tab->label }}
                            </div>
                            </a>
                            <div :class="{ 'show': cards.{{ $key }}, 'card-body collapse' : true}" id="{{ $key }}">
                                @include($tab->view)
                            </div>
                        </div>

                    @endforeach


                </div>
            </div>

            <div class="form-group">
                <button type="submit" 
                        :disabled='isSaveButtonDisabled'
                        class="btn btn-primary" 
                        name="save" 
                        onclick="jQuery('#product-save-form').submit()">
                    Save Product
                </button>
                
                <button type="button"  class="btn" onclick="location='{{ route('admin.product.index') }}'">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    </product-field-page>
</div>
@endsection


