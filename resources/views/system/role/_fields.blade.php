
 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.role.name') }}"
        field-name="name"
        init-value="{{ $role->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>

 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.role.description') }}"
        field-name="description"
        init-value="{{ $role->description ?? '' }}" 
        error-text="{{ $errors->first('description') }}"
    >
    </avored-input>
</div>


<a-row type="flex" :gutter="16">
    @foreach ($permissions as $group)
        <a-col class="mt-1"  :span="6">
            <a-card title="{{ $group->label() }}">
                @foreach ($group->permissionList as $permission)
                    <div class="mt-3 flex w-full">
                        <avored-toggle
                            label-text="{{ $permission->label() }}"
                            field-name="permissions[{{ $permission->routes() }}]"
                            {{-- toggle-on-value="ENABLED"
                            toggle-off-value="DISABLED" --}}
                            init-value="{{ (isset($role) && $role->hasPermission($permission->routes())) ? 1 : 0 }}"
                        >
                        </avored-toggle>
                    </div>
                @endforeach
            </a-card>
        </a-col>
            
    @endforeach
</a-row>
