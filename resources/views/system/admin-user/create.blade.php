@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.admin-user.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.admin-user.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <admin-user-save base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="adminUserForm"
                method="post"
                action="{{ route('admin.admin-user.store') }}"                    
                @submit="handleSubmit"
            >
                @csrf

                @include('avored::system.admin-user._fields')
                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.btn.save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="cancelAdminUser"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </language-save>
    </a-col>
</a-row>
@endsection
