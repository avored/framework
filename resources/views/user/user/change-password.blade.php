@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header h4">
            {{ __('avored-framework::user.change-password') }}
        </div>

        <div class="card-body">
            
            <form method="post" action="{{ route('admin.user.change-password.update', $user->id) }}">
                @csrf()
                @method('put')

        
                @include('avored-framework::forms.password',
                                ['name' => 'password' ,
                                'label' => __('avored-framework::user.new-password')
                                ])
                @include('avored-framework::forms.password',
                                ['name' => 'password_confirmation' ,
                                'label' => __('avored-framework::user.confirm-password')
                                ])

                <button class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('admin.user.index') }}" class="btn" >Cancel</a>


            </form>
          
    
        </div>
    </div>

@stop