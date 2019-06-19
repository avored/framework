<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::system.role.name') }}">
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {initialValue: '{{ ($role->name) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                }
            ]
        }
        ]"></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('description'))
        validate-status="error"
        help="{{ $errors->first('description') }}"
    @endif
    label="{{ __('avored::system.role.description') }}">

    <a-input
        name="description"
        default-value="{{ $role->description ?? '' }}"
       ></a-input>
</a-form-item>

<a-row type="flex" :gutter="16">
    @foreach ($permissions as $group)
        <a-col class="mt-1"  :span="6">
            <a-card title="{{ $group->label() }}">
                @foreach ($group->permissionList as $permission)
                    <div class="{{ ($loop->index > 0) ? 'mt-1' : ''  }} ">
                        <a-switch
                            {{ (isset($role) && $role->hasPermission($permission->routes())) ? 'default-checked' : '' }}
                            key="{{ $permission->key() }}"
                            v-on:change="onUserPermissionSwitchChange($event, '{{ $permission->key() }}')"
                        >
                        </a-switch>
                        
                        <input
                            id="permissions-{{ $permission->key() }}"
                            type="hidden"
                            value="{{ (isset($role)) ? $role->hasPermission($permission->routes()) : 0 }}"
                            name="permissions[{{ $permission->routes() }}]"  />
                        {{ $permission->label() }}
                    </div>
                @endforeach

            </a-card>
        </a-col>
            
    @endforeach
</a-row>
