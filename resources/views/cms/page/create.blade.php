@extends('avored-framework::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create Page</div>
                    <div class="card-body">
                        <form action="{{ route('admin.page.store') }}" method="post">

                            @csrf
                            <cms-page-field-page  inline-template>
                                <div>
                                    @include('avored-framework::cms.page._fields')                     
                                </div>
                            </cms-page-field-page>
                            
                            
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create Page</button>
                                <a href="{{ route('admin.page.index') }}" class="btn">Cancel</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
