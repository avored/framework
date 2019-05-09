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
        <role-edit
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
                        {initialValue: '{{ $role->name }}' },
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
                    <a-input name="description" default-value="{{ $role->description }}"></a-input>
                </a-form-item>


                <a-row type="flex" :gutter="16">
                    @foreach ($permissions as $group)
                        <a-col class="mt-1"  :span="6">
                            <a-card title="{{ $group->label() }}">
                                @foreach ($group->permissionList as $permission)
                                    <div class="{{ ($loop->index > 0) ? 'mt-1' : ''  }} ">
                                        <a-switch
                                            {{ ($role->hasPermission($permission->routes())) ? 'default-checked' : '' }}
                                            key="{{ $permission->key() }}"
                                            v-on:change="onUserPermissionSwitchChange($event, '{{ $permission->key() }}')"
                                        >
                                        </a-switch>
                                       
                                        <input
                                            id="permissions-{{ $permission->key() }}"
                                            type="hidden"
                                            value="{{ $role->hasPermission($permission->routes()) }}"
                                            name="permissions[{{ $permission->routes() }}]"  />
                                        {{ $permission->label() }}
                                    </div>
                                @endforeach

                            </a-card>
                        </a-col>
                           
                    @endforeach
                   
                   
                </a-row>
                
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
        </role-edit>
    </a-col>
</a-row>
@endsection
