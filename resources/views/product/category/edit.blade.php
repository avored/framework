@extends('avored-framework::layouts.app')

@section('page-header')
    <div class="h1 mt-1">
        {{ __('avored-framework::product.category.edit_title') }}
    </div>
@endsection

@section('content')
<category-field-page category="{{ json_encode($category->getTranslation()) }}" inline-template>

    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route('admin.category.update', $category->id) }}">

                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="peer float-left">
                            <a href="#" 
                                :class="{ 'bg-primary text-white' : openAllCard ,'px-4 py-2 mr-3 rounded-pill' : true }"
                                @click.prevent="openAllCardLink"
                            >
                                {{ __('avored-framework::product.category.category_all') }}
                            </a>

                            <a href="#"
                                @click.prevent="toggleCard('basic')"
                                :class="{ 'bg-primary text-white' :linkTitle.basic,'px-4 py-2 mr-3 bg-default rounded-pill' : true }"
                            >
                                {{ __('avored-framework::product.category.basic_info') }}
                            </a>

                            <a href="#"
                                @click.prevent="toggleCard('seo')"
                                :class="{ 'bg-primary text-white' :linkTitle.seo,'px-4 py-2 bg-default rounded-pill' : true }"
                            >
                                {{ __('avored-framework::product.category.seo') }}
                            </a>
                        </div>

                        <div class="float-right">
                            <div class="form-group-sm text-small">
                                <select
                                    name="language"
                                    @input="changeLanguage"
                                    class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}"
                                    id="language"
                                >
                                    @foreach ($languages as $language)
                                        <option
                                            data-url="{{ route('admin.category.edit', ['category' => $category->id ,'language_id' => $language->id]) }}"
                                            value="{{ $language->id }}"
                                        >
                                            {{ $language->name }}
                                        </option>
                                    @endforeach
                                </select>
                                    @if ($errors->has('language'))
                                    <span class='invalid-feedback'>
                                        <strong>{{ $errors->first('language') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <span class="float-left">
                            {{ __('avored-framework::product.category.basic_info') }}
                        </span>
                        <span class="float-right">
                            <a href="" @click.prevent="toggleCard('basic')">
                                <i :class="{ 'ti-arrow-circle-down': cardBody.basic, 'ti-arrow-circle-up': !cardBody.basic}"></i>
                            </a>
                        </span>
                    </div>
                    <div :class="{ 'd-none': !cardBody.basic, 'card-body' : true }">
                        @csrf()
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">{{ __('avored-framework::product.category.name') }}</label>
                                    <input type="text"
                                        name="name"
                                        v-model="name"
                                        :autofocus="true"
                                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="name" />
                                        @if ($errors->has('name'))
                                            <span class='invalid-feedback'>
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="slug">
                                        {{ __('avored-framework::product.category.slug') }}
                                    </label>
                                    <input type="text"
                                        name="slug"
                                        v-model="slug"
                                        class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                        id="slug" />
                                        @if ($errors->has('slug'))
                                            <span class='invalid-feedback'>
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="parent_id">
                                        {{ __('avored-framework::product.category.parent') }}
                                    </label>
                                    <select
                                        name="parent_id"
                                        class="form-control {{ $errors->has('parent_id') ? ' is-invalid' : '' }}"
                                        id="parent_id"
                                    >
                                
                                        @foreach ($categoryOptions as $option)
                                            <option
                                                @if ($option->id == $category->id)
                                                    selected
                                                @endif
                                                value="{{ $option->id }}" >
                                                {{ $option->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('parent_id'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                    
                        <span class="float-left">
                            {{ __('avored-framework::product.category.seo') }}
                        </span>
                        <span class="float-right">
                            <a href="" @click.prevent="toggleCard('seo')">
                                <i :class="{ 'ti-arrow-circle-down': cardBody.seo, 'ti-arrow-circle-up': !cardBody.seo}"></i>
                            </a>
                        </span>
                    </div>
                    <div :class="{ 'd-none': !cardBody.seo, 'card-body' : true }">
                        <div class="form-group">
                            <label for="meta_title">
                                {{ __('avored-framework::product.category.meta_title') }}
                            </label>
                            <input type="text"
                                name="meta_title"
                                v-model="meta_title"
                                class="form-control {{ $errors->has('meta_title') ? ' is-invalid' : '' }}"
                                id="meta_title" />
                                @if ($errors->has('meta_title'))
                                <span class='invalid-feedback'>
                                    <strong>{{ $errors->first('meta_title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="meta_description">
                                {{ __('avored-framework::product.category.meta_description') }}
                            </label>
                            <input type="text"
                                name="meta_description"
                                v-model="meta_description"
                                class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
                                id="meta_description" />
                                @if ($errors->has('meta_description'))
                                <span class='invalid-feedback'>
                                    <strong>{{ $errors->first('meta_description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="language_id" value="{{ request()->get('language_id', $defaultLanguage->id) }}" />
                <button type="submit"  class="btn btn-primary category-save-button">
                    {{ __('avored-framework::product.category.edit_button') }}
                </button>

                <a href="{{ route('admin.category.index') }}" class="btn btn-default">
                    {{ __('avored-framework::lang.cancel') }}
                </a>
            </form>
        </div>
    </div>
</category-field-page>
@endsection
