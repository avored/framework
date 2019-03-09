@extends('avored-framework::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Page</div>
                <div class="card-body">

                    <form action="{{ route('admin.page.update', $model->id) }}" method="post">
                        @csrf
                        @method('put')
                        <cms-page-field-page :page="{{ $model }}" inline-template>
                                <div>
                                    @include('avored-framework::cms.page._fields')                     
                                </div>
                            </cms-page-field-page>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Page</button>
                            <a href="{{ route('admin.page.index') }}" class="btn">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
