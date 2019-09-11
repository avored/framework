<a-form-item
    @if ($errors->has('first_name'))
        validate-status="error"
        help="{{ $errors->first('first_name') }}"
    @endif
    label="{{ __('avored::system.admin-user.first_name') }}"
>
    <a-input
        :auto-focus="true"
        name="first_name"
        v-decorator="[
        'first_name',
        {initialValue: '{{ ($adminUser->first_name) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'First Name']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('last_name'))
        validate-status="error"
        help="{{ $errors->first('last_name') }}"
    @endif
    label="{{ __('avored::system.admin-user.last_name') }}"
>
    <a-input
        name="last_name"
        v-decorator="[
        'last_name',
        {initialValue: '{{ ($adminUser->last_name) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Last Name']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('is_super_admin'))
        validate-status="error"
        help="{{ $errors->first('is_super_admin') }}"
    @endif
    label="{{ __('avored::system.admin-user.is_super_admin') }}"
>
    <a-switch
        {{ (isset($adminUser) && $adminUser->is_super_admin) ? 'default-checked' : '' }}
        v-on:change="isLanguageDefaultSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" v-model="is_super_admin" name="is_super_admin"  />

<a-form-item
    @if ($errors->has('email'))
        validate-status="error"
        help="{{ $errors->first('email') }}"
    @endif
    label="{{ __('avored::system.admin-user.email') }}"
>
    <a-input
        name="email"
        @if (isset($adminUser))
            disabled
        @endif
        v-decorator="[
        'email',
        {initialValue: '{{ ($adminUser->email) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Email']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('image_file'))
        validate-status="error"
        help="{{ $errors->first('image_file') }}"
    @endif
    label="{{ __('avored::system.admin-user.image_file') }}"
>
    <a-upload 
        name="image_file"
        :default-file-list="userImageList"
        :multiple="false"
        list-type="picture"
        action="{{ route('admin.admin-user-image-upload') }}" 
        :headers="headers"
        v-on:change="handleUploadImageChange">
        <a-button>
        <a-icon type="upload"></a-icon> Click to Upload
        </a-button>
    </a-upload>
</a-form-item>
<input type="hidden" name="image_path" v-model="image_path" />

@if (!isset($adminUser))
    <a-form-item
        @if ($errors->has('password'))
            validate-status="error"
            help="{{ $errors->first('password') }}"
        @endif
        label="{{ __('avored::system.admin-user.password') }}"
    >
        <a-input
            name="password"
            type="password"
            v-decorator="[
            'password',
            {rules: 
                [
                    {   required: true, 
                        message: '{{ __('avored::validation.required', ['attribute' => 'Password']) }}' 
                    }
                ]
            }
            ]"
        ></a-input>
    </a-form-item>

    <a-form-item
        @if ($errors->has('password_confirmation'))
            validate-status="error"
            help="{{ $errors->first('password_confirmation') }}"
        @endif
        label="{{ __('avored::system.admin-user.password_confirmation') }}"
    >
        <a-input
            name="password_confirmation"
            type="password"
            v-decorator="[
            'password_confirmation',
            {rules: 
                [
                    {   required: true, 
                        message: '{{ __('avored::validation.required', ['attribute' => 'Confirm Password']) }}' 
                    }
                ]
            }
            ]"
        ></a-input>
    </a-form-item>
@endif

<a-form-item
    @if ($errors->has('language'))
        validate-status="error"
        help="{{ $errors->first('language') }}"
    @endif
    label="{{ __('avored::system.admin-user.language') }}"
>
    <a-select
        v-on:change="handleLanguageChange"
        v-decorator="[
        'language',
        {initialValue: '{{ ($adminUser->language) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Language']) }}' 
                }
            ]
        }
        ]"
    >
        <a-select-option value="en">English</a-select-option>
    </a-select>
</a-form-item>
<input type="hidden" v-model="language" name="language"  />

<a-form-item
    @if ($errors->has('role_id'))
        validate-status="error"
        help="{{ $errors->first('role_id') }}"
    @endif
    label="{{ __('avored::system.admin-user.role_id') }}"
>
    <a-select
        name="role_id"
        v-on:change="handleRoleChange"
        v-decorator="[
        'role_id',
        {initialValue: '{{ ($adminUser->role_id) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Role']) }}' 
                }
            ]
        }
        ]"
    >   
        @foreach ($roleOptions as $roleId => $roleName)
            <a-select-option value="{{ $roleId }}">{{ $roleName }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" v-model="role_id" name="role_id"  />
