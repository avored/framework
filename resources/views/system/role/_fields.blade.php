
<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $role->name ?? ''
    ])
</div>
<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'description',
        'label' => __('avored::system.description'),
        'value' => $role->description ?? ''
    ])
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
                            @include('avored::system.form.toggle', [
                                'name' => 'permissions[{{ $permission->routes() }}]',
                                'label' => $permission->label(),
                                'value' => (isset($role) && $role->hasPermission($permission->routes())) ? 1 : 0,
                                'checkedValue' => 1,
                                'unCheckedValue' => 0,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>  
    @endforeach
</div>
