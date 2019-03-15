@extends('avored-framework::layouts.app')

@section('page-header')
    <div class="h1 float-left">
        {{ __('avored-framework::product.attribute.edit_title') }}
    </div>

    @if (Session::get('multi_language_enabled'))
        <div class="float-right ">
            <div class="form-group-sm text-small">
                <select
                    name="language"
                    @input="changeLanguage"
                    class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}"
                    id="language"
                >
                    @foreach ($languages as $language)
                        <option
                            data-url="{{ route('admin.attribute.edit', ['category' => $attribute->id ,'language_id' => $language->id]) }}"
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
    @endif
    <div class="clearfix"></div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">{{ __('avored-framework::product.attribute.basic_info') }}</div>
            <div class="card-body">
                <form action="{{ route('admin.attribute.update', $attribute->id) }}" method="post">
                    @csrf
                    @method('put')
                    <?php 
                    $attribute->attributeDropdownOptions;
                    ?>
                    <attribute-field-page inline-template :model="{{ $attribute }}">
                            <div>
                                @include('avored-framework::product.attribute._fields')
                            </div>
                        </attribute-field-page>                    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            {{ __('avored-framework::attribute.edit') }}
                        </button>
                        <a href="{{ route('admin.attribute.index') }}" 
                                class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
