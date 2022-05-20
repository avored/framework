
<div class="mt-3">
    <x-avored::form.input
        name="name"
        autofocus
        value="{{ $role->name ?? '' }}"
        label="{{ __('avored::system.name') }}"
    ></x-avored::form.input>
</div>

<div class="grid grid-cols-4 gap-5">
    @foreach ($permissions as $group)
        <div class="mt-3">
            <div class="rounded border">
                <div class="p-3 border-b">
                    {{ $group->label() }}
                </div>
                <div class="p-3">
                    @foreach ($group->permissionList as $permission)
                        <div class="mt-1">
                            <x-avored::form.checkbox
                                name="permissions[{{ $permission->routes() }}]"
                                value="{{ (isset($role) && $role->hasPermission($permission->routes())) ? 1 : 0  }}"
                                label="{{ $permission->label() }}"
                            >
                            </x-avored::form.checkbox>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
