 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.first_name') }}"
        field-name="first_name"
        init-value="{{ $adminUser->first_name ?? '' }}" 
        error-text="{{ $errors->first('first_name') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.last_name') }}"
        field-name="last_name"
        init-value="{{ $adminUser->last_name ?? '' }}" 
        error-text="{{ $errors->first('last_name') }}"
    >
    </avored-input>
</div>


<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.is_super_admin') }}"
        error-text="{{ $errors->first('is_super_admin') }}"
        field-name="is_super_admin"
        init-value="{{ $adminUser->is_super_admin ?? '' }}"
    >
    </avored-toggle>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.email') }}"
        field-name="email"
        init-value="{{ $adminUser->email ?? '' }}" 
        error-text="{{ $errors->first('email') }}"
        :is-disabled="true"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-upload
            label-text="{{ __('avored::system.fields.image_file') }}"
            field-name="image_path"
            init-value="{{ $adminUser->image_path ?? '' }}" 
            error-text="{{ $errors->first('image_path') }}"
            upload-url="{{ route('admin.admin-user-image-upload') }}"
        >
    </avored-upload>
</div>


@if (!isset($adminUser))

    <div class="mt-3 flex w-full">
        <avored-input
            label-text="{{ __('avored::system.fields.password') }}"
            field-name="password"
            type="password"
            init-value="{{ $adminUser->password ?? '' }}" 
            error-text="{{ $errors->first('password') }}"
        >
        </avored-input>
    </div>
    <div class="mt-3 flex w-full">
        <avored-input
            label-text="{{ __('avored::system.fields.password_confirmation') }}"
            field-name="password_confirmation"
            type="password_confirmation"
            init-value="{{ $adminUser->password_confirmation ?? '' }}" 
            error-text="{{ $errors->first('password_confirmation') }}"
        >
        </avored-input>
    </div>
@endif



<div class="mt-3 w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.language') }}"
        error-text="{{ $errors->first('language') }}"
        field-name="language"
        :options="{{ json_encode($languageOptions) }}"
        init-value="{{ $adminUser->language ?? '' }}"
    >
    </avored-select>
</div>

<div class="mt-3 mb-6 w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.role_id') }}"
        error-text="{{ $errors->first('role_id') }}"
        field-name="role_id"
        :options="{{ json_encode($roleOptions) }}"
        init-value="{{ $adminUser->role_id ?? '' }}"
    >
    </avored-select>
</div>
