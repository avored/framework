@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.admin-user.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.admin-user.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <admin-user-save base-url="{{ asset(config('avored.admin_url')) }}" :admin-user="{{ $adminUser }}" inline-template>
        <div>
            <a-form 
                :form="adminUserForm"
                method="post"
                action="{{ route('admin.admin-user.update', $adminUser->id) }}"                    
                @submit="handleSubmit"
            >
                @csrf
                @method('put')
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
        </admin-user-save>
    </a-col>
</a-row>
@endsection
