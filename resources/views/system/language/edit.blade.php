@extends('avored-framework::layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ __('avored-framework::system.language.update') }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.language.update', $model->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="name">
                            {{ __('avored-framework::system.language.name') }}
                        </label>
                        <input type="text"
                            name="name"
                            autofocus
                            value="{{ $model->name }}"
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
                            value="{{ $model->code }}"
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
                            <option value='0' {{ $model->is_default == 0 ? 'selected' : '' }}>
                                {{ __('avored-framework::system.language.no') }}
                            </option>
                            <option value='1' {{ $model->is_default == 1 ? 'selected' : '' }}>
                                {{ __('avored-framework::system.language.yes') }}
                            </option>
                        </select>
                            @if ($errors->has('is_default'))
                            <span class='invalid-feedback'>
                                <strong>{{ $errors->first('is_default') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            {{ __('avored-framework::system.language.update') }}
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
