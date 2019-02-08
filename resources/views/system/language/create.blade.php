@extends('avored-framework::layouts.app')

@section('content')

    <div id="admin-language-page" class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.language.create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.language.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="name">
                                {{ __('avored-framework::system.language.name') }}
                            </label>
                            <input type="text"
                                name="name"
                                autofocus
                                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                id="name" />
                                @if ($errors->has('name'))
                                <span class='invalid-feedback'>
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="code">
                                {{ __('avored-framework::system.language.code') }}
                            </label>
                            <input type="text"
                                name="code"
                                class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}"
                                id="code" />
                                @if ($errors->has('code'))
                                <span class='invalid-feedback'>
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="is_default">
                                {{ __('avored-framework::system.language.is_default') }}
                            </label>
                            <select name="is_default" class="form-control">
                                <option value='0'>{{ __('avored-framework::system.language.no') }}</option>
                                <option value='1'>{{ __('avored-framework::system.language.yes') }}</option>
                            </select>
                                @if ($errors->has('is_default'))
                                <span class='invalid-feedback'>
                                    <strong>{{ $errors->first('is_default') }}</strong>
                                </span>
                            @endif
                        </div>



                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.language.create') }}
                            </button>
                            <a href="{{ route('admin.language.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
