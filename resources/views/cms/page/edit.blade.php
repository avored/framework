@extends('avored-framework::layouts.app')

@section('content')
<div class="container">
<cms-page-field-page inline-template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit Page
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
                                            data-url="{{ route('admin.page.edit', ['id' => $page->id ,'language_id' => $language->id]) }}"
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

                    <form action="{{ route('admin.page.update', $page->id) }}" method="post">
                        @csrf
                        @method('put')
                        
                                <div>
                                    @include('avored-framework::cms.page._fields')                     
                                </div>
                           

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Page</button>
                            <a href="{{ route('admin.page.index') }}" class="btn">Cancel</a>
                        </div>
                        <input type="hidden" name="language_id" value="{{ request()->get('language_id', $defaultLanguage->id) }}" />
                

                    </form>

                </div>
            </div>

        </div>
    </div>
</cms-page-field-page>
</div>
@endsection
