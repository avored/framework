@extends('avored-framework::layouts.app')


@section('content')
<div id="admin-category-create-page">
    <div class="row">
        <div class="col-12">
            <div class="h1 mt-1">Create Category</div>

            <form method="post" action="{{ route('admin.category.store') }}">
                @csrf
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
                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" />
                                                @if ($errors->has('name'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">
                                                {{ __('avored-framework::product.category.slug') }}
                                            </label>
                                            <input type="text"
                                                name="default_language[slug]"
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
                                                name="{{ $additionalLanguage->id }}[name]"
                                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" />
                                                @if ($errors->has('name'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">
                                                {{ __('avored-framework::product.category.slug') }}
                                            </label>
                                            <input type="text"
                                                name="{{ $additionalLanguage->id }}[slug]"
                                                class="form-control {{ $errors->has('slug') ? ' is-invalid' : '' }}"
                                                id="slug" />
                                                @if ($errors->has('slug'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('slug') }}</strong>
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
                                                name="default_language[meta_description]"
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
                                                name="{{ $additionalLanguage->id }}[meta_title]"
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
                                                name="{{ $additionalLanguage->id }}[meta_description]"
                                                class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
                                                id="meta_description" />
                                                @if ($errors->has('meta_description'))
                                                <span class='invalid-feedback'>
                                                    <strong>{{ $errors->first('meta_description') }}</strong>
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

                <button type="submit"  class="btn btn-primary category-save-button">Create Category</button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
