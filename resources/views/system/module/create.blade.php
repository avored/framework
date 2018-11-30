@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-framework::system.module-upload') }}
                </div>
                <div class="card-body">
                    <form method="post"
                          action="{{ route('admin.module.store') }}"
                          enctype="multipart/form-data">

                        @csrf()

                        <div class="form-group">
                            <label for="module_zip_file">
                                {{ __('avored-framework::system.module-upload-file') }}
                            </label>
                            <input type="file" 
                                class="form-control" 
                                name="module_zip_file" 
                                id="module_zip_file"/>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('avored-framework::system.module-upload') }}
                            </button>

                            <a href="{{ route('admin.module.index') }}" class="btn">{{ __('avored-framework::lang.cancel') }}</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
