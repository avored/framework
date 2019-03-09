@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.state-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.state.update', $model->id) }}" 
                      
                        method="post">
                        @csrf()
                        @method('put')

                        <state-field-page inline-template :model="{{ $model }}">
                            <div>
                                @include('avored-framework::system.state._fields')
                            </div>
                        </state-field-page>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::system.state-update') }}
                            </button>
                            <a href="{{ route('admin.state.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
