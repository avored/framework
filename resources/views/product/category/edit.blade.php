@extends('avored-framework::layouts.app')


@section('content')
<div id="admin-category-create-page">
    <div class="row">
        <div class="col-12">
            <div class="h1 mt-1">
                {{ __('avored-framework::product.category.edit_title') }}
            </div>

            <form method="post" action="{{ route('admin.category.update', $category->id) }}">
                @csrf
                @method('put')
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        {{ __('avored-framework::product.category.basic_info') }}
                    </div>
                    <div class="card-body">
                        @if ($isMutliLanguage)
                        <div class="row">
                            <div class="col-md-6">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" 
                                        href="#default-language-{{ $defaultLanguage->id }}" 
                                        class="nav-link active" href="#">
                                        {{ $defaultLanguage->name }}
                                    </a>
                                </li>
                            </ul>
                                <div class="tab-content">
                                    <div
                                        class="tab-pane fade active show" 
                                        id="addtional-language-{{ $defaultLanguage->id }}" 
                                        role="tabpanel">
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __('avored-framework::product.category.name') }}
                                            </label>
                                            <input type="text"
                                                name="default_language[name]"
                                                value="{{ $category->name }}"
                                                class="form-control {{ $errors->has('default_language.name') ? ' is-invalid' : '' }}"
                                                id="name" />
                                                @if ($errors->has('default_language.name'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('default_language.name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">
                                                {{ __('avored-framework::product.category.slug') }}
                                            </label>
                                            <input type="text"
                                                name="default_language[slug]"
                                                value="{{ $category->slug }}"
                                                class="form-control {{ $errors->has('default_language.slug') ? ' is-invalid' : '' }}"
                                                id="slug" />
                                                @if ($errors->has('default_language.slug'))
                                                    <span class='invalid-feedback'>
                                                        <strong>{{ $errors->first('default_language.slug') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <ul class="nav nav-tabs">
                                    @foreach ($additionalLanguages as $additionalLanguage)
                                        <li class="nav-item">
                                            <a data-toggle="tab" 
                                                href="#addtional-language-basic-{{ $additionalLanguage->id }}" 
                                                class="nav-link {{ $loop->index == 0 ? 'active' : '' }} " href="#">
                                                {{ $additionalLanguage->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                @foreach ($additionalLanguages as $additionalLanguage)
                                    <div 
                                        class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}" 
                                        id="addtional-language-basic-{{ $additionalLanguage->id }}" 
                                        role="tabpanel"
                                    >

                                         <div class="form-group">
                                            <label for="name">
                                                {{ __('avored-framework::product.category.name') }}
                                            </label>
                                            <input type="text"
                                                name="additional_languages[{{ $additionalLanguage->id }}][name]"
                                                value="{{ $category->getTranslation('name', $additionalLanguage->id) }}"
                                                class="form-control {{ $errors->has('additional_languages.' . $additionalLanguage->id . '.name') ? ' is-invalid' : '' }}"
                                                id="name" />
                                                @if ($errors->has('additional_languages.' . $additionalLanguage->id . '.name'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('additional_languages.' . $additionalLanguage->id . '.name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">
                                                {{ __('avored-framework::product.category.slug') }}
                                            </label>
                                            <input type="text"
                                                name="additional_languages[{{ $additionalLanguage->id }}][slug]"
                                                value="{{ $category->getTranslation('slug', $additionalLanguage->id) }}"
                                                class="form-control {{ $errors->has('additional_languages.' . $additionalLanguage->id . '.slug') ? ' is-invalid' : '' }}"
                                                id="slug" />
                                                @if ($errors->has('additional_languages.' . $additionalLanguage->id . '.slug'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('additional_languages.' . $additionalLanguage->id . '.slug') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                          
                                    </div>
                                    
                                @endforeach
                                    
                                </div>  
                            </div>

                            <hr/>

                            <div class="col-md-12 border-top pt-3">
                                <div class="form-group">
                                    <label>
                                        {{ __('avored-framework::product.category.parent') }}
                                    </label>
                                    <select 
                                        name="default_language[parent_id]"
                                        class="form-control {{ $errors->has('default_language.parent_id') ? ' is-invalid' : '' }}"
                                        id="parent_id"
                                        >
                                        @foreach ($categoryOptions as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('default_language.parent_id'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('default_language.parent_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="card mt-3 mb-3">
                    <div class="card-header">{{ __('avored-framework::product.category.seo') }}</div>
                    <div class="card-body">
                        
                        @if ($isMutliLanguage)
                        <div class="row">
                            <div class="col-md-6">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" 
                                        href="#default-language-{{ $defaultLanguage->id }}" 
                                        class="nav-link active" href="#">
                                        {{ $defaultLanguage->name }}
                                    </a>
                                </li>
                            </ul>
                                <div class="tab-content">
                                    <div
                                        class="tab-pane fade active show" 
                                        id="addtional-language-{{ $defaultLanguage->id }}" 
                                        role="tabpanel">
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __('avored-framework::product.category.meta_title') }}
                                            </label>
                                            <input type="text"
                                                name="default_language[meta_title]"
                                                value="{{ $category->meta_title }}"
                                                class="form-control {{ $errors->has('default_language.meta_title') ? ' is-invalid' : '' }}"
                                                id="meta_title" />
                                                @if ($errors->has('default_language.meta_title'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('default_language.meta_title') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description">
                                                {{ __('avored-framework::product.category.meta_description') }}
                                            </label>
                                            <input type="text"
                                                name="default_language[meta_description]"
                                                value="{{ $category->meta_description }}"
                                                class="form-control {{ $errors->has('default_language.meta_description') ? ' is-invalid' : '' }}"
                                                id="meta_description" />
                                                @if ($errors->has('default_language.meta_description'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('default_language.meta_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <ul class="nav nav-tabs">
                                    @foreach ($additionalLanguages as $additionalLanguage)
                                        <li class="nav-item">
                                            <a data-toggle="tab" 
                                                href="#addtional-language-seo-{{ $additionalLanguage->id }}" 
                                                class="nav-link {{ $loop->index == 0 ? 'active' : '' }} " href="#">
                                                {{ $additionalLanguage->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                @foreach ($additionalLanguages as $additionalLanguage)
                                    <div 
                                        class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}" 
                                        id="addtional-language-seo-{{ $additionalLanguage->id }}" 
                                        role="tabpanel"
                                    >

                                         <div class="form-group">
                                            <label for="meta_title">
                                                {{ __('avored-framework::product.category.meta_title') }}
                                            </label>
                                            <input type="text"
                                                name="additional_languages[{{ $additionalLanguage->id }}][meta_title]"
                                                value="{{ $category->getTranslation('meta_title', $additionalLanguage->id) }}"
                                                class="form-control {{ $errors->has('additional_languages.' . $additionalLanguage->id . '.meta_title') ? ' is-invalid' : '' }}"
                                                id="meta_title" />
                                                @if ($errors->has('additional_languages.' . $additionalLanguage->id . '.meta_title'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('additional_languages.' . $additionalLanguage->id . '.meta_title') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_description">
                                                {{ __('avored-framework::product.category.meta_description') }}
                                            </label>
                                            <input type="text"
                                                name="additional_languages[{{ $additionalLanguage->id }}][meta_description]"
                                                value="{{ $category->getTranslation('meta_description', $additionalLanguage->id) }}"
                                                class="form-control {{ $errors->has('additional_languages.' . $additionalLanguage->id . '.meta_description') ? ' is-invalid' : '' }}"
                                                id="meta_description" />
                                                @if ($errors->has('additional_languages.' . $additionalLanguage->id . '.meta_description'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('additional_languages.' . $additionalLanguage->id . '.meta_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                          
                                    </div>
                                    
                                @endforeach
                                    
                                </div>  
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <button type="submit"  class="btn btn-primary category-save-button">
                    {{ __('avored-framework::product.category.edit_button') }}
                </button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-default">
                    {{ __('avored-framework::lang.cancel') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
