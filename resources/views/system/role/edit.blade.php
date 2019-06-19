@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.role.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.role.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <system-role-save
            base-url="{{ asset(config('avored.admin_url')) }}"
            role="{{ $role }}" inline-template>
        <div>
            <a-form 
                :form="roleForm"
                method="post"
                action="{{ route('admin.role.update', $role->id) }}"                    
                @submit="handleSubmit"
            >
                    @csrf
                    @method('put')

                    @include('avored::system.role._fields')
                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.btn.save') }}
                    </a-button>
                    
                    <a-button
                        style="margin-left: 10px;"
                        type="default"
                        v-on:click.prevent="cancelRole"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </system-role-save>
    </a-col>
</a-row>
@endsection
