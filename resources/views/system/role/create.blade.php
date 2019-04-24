@extends('avored::layouts.app')


@section('meta_title')
    {{ __('avored::system.role.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.role.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <role-create base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="roleForm"
                method="post"
                action="{{ route('admin.role.store') }}"                    
                @submit="handleSubmit"
            >
                    @csrf
               <a-form-item
                    @if ($errors->has('name'))
                        validate-status="error"
                        help="{{ $errors->first('name') }}"
                    @endif
                    label="{{ __('avored::system.role.name') }}"
                >
                    <a-input
                        :auto-focus="true"
                        name="name"
                        v-decorator="[
                        'name',
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                }
                            ]
                        }
                        ]"
                    ></a-input>
                </a-form-item>
                <a-form-item
                    @if ($errors->has('description'))
                        validate-status="error"
                        help="{{ $errors->first('description') }}"
                    @endif
                    label="{{ __('avored::system.role.description') }}"
                >   
                    <a-input name="description"></a-input>
                </a-form-item>
                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.role.save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="cancelRole"
                    >
                        {{ __('avored::system.role.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </role-create>
    </a-col>
</a-row>
@endsection
