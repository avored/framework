@extends('avored-framework::layouts.app')

@section('content')
    <div class="row">
    
    <property-field-page inline-template>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::product.property.edit_title') }}
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
                                        data-url="{{ route('admin.property.edit', ['id' => $property->id ,'language_id' => $language->id]) }}"
                                        @if ($language->id == request()->get('language_id', $defaultLanguage->id))
                                        selected
                                        @endif
                                        value="{{ $language->id }}"
                                    >
                                        {{ $language->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.property.update', $property->id) }}" method="post">
                        @csrf
                        @method('put')

                        @include('avored-framework::product.property._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::property.edit') }}
                            </button>
                            <a href="{{ route('admin.property.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </property-field-page>
    </div>
@endsection
