@extends('avored-framework::layouts.app')

@section('content')

    <div  class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.country-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.country.update', $model->id) }}" 
                      
                        method="post">
                        @csrf()
                        @method('put')
                        
                        <country-field-page inline-template :model="{{ $model }}">
                            <div>
                                @include('avored-framework::system.country._fields')
                            </div>
                        </country-field-page>
                        
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-framework::user.country-update') }}
                            </button>
                            <a href="{{ route('admin.country.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
