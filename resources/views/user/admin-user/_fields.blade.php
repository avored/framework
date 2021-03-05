<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'first_name',
        'label' => __('avored::system.first-name'),
        'value' => $adminUser->first_name ?? ''
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'last_name',
        'label' => __('avored::system.last-name'),
        'value' => $adminUser->last_name ?? ''
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.toggle', [
        'name' => 'is_super_admin',
        'label' => __('avored::system.is-super-admin'),
        'value' => $adminUser->is_super_admin ?? null
    ])
</div>

<div class="flex mt-3 w-full">
    @php
        if(isset($adminUser)) {
            $attrs['disabled'] = true;
        } else {
            $attrs = [];
        }
    @endphp
    @include('avored::system.form.input', [
        'name' => 'email',
        'label' => __('avored::system.email'),
        'value' => $adminUser->email ?? '',
        'attrs' => $attrs
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'image_path',
        'type' => 'file',
        'label' => __('avored::system.image-file'),
        'value' => $adminUser->image_path ?? ''
    ])
</div>


@if (!isset($adminUser))

    <div class="flex mt-3 w-full">
        @include('avored::system.form.input', [
            'type' => 'password',
            'name' => 'password',
            'label' => __('avored::system.password'),
            'value' => $adminUser->email ?? ''
        ])
    </div>
    <div class="flex mt-3 w-full">
        @include('avored::system.form.input', [
            'type' => 'password',
            'name' => 'password_confirmation',
            'label' => __('avored::system.password-confirmation'),
            'value' => $adminUser->password_confirmation ?? ''
        ])
    </div>
        
@endif


<div class="flex mt-3 w-full">
    @include('avored::system.form.select', [
        'name' => 'language',
        'label' => __('avored::system.language'),
        'value' => $adminUser->language ?? '',
        'options' => $languageOptions
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.select', [
        'name' => 'role_id',
        'label' => __('avored::system.role-id'),
        'value' => $adminUser->role_id ?? '',
        'options' => $roleOptions
    ])
</div>
