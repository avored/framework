@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.state.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.state.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <state-save base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="stateForm"
                method="post"
                action="{{ route('admin.state.store') }}"                    
                @submit="handleSubmit"
            >
                @csrf

                @include('avored::system.state._fields')
                
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
                        v-on:click.prevent="cancelState"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </state-save>
    </a-col>
</a-row>
@endsection
