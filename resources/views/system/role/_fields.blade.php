
 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $role->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>

 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.description') }}"
        field-name="description"
        init-value="{{ $role->description ?? '' }}" 
        error-text="{{ $errors->first('description') }}"
    >
    </avored-input>
</div>


<div class="flex flex-wrap"> 
    @foreach ($permissions as $group)
        <div class="mt-3 w-1/4">
            <div class="ml-3 rounded border">
                <div class="p-5 border-b">
                    {{ $group->label() }}
                </div>
                <div class="p-5">
                    @foreach ($group->permissionList as $permission)
                        <div class="mt-1 flex w-full">
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
                </div>
            </div>
        </div>  
    @endforeach
</div>
