
<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text"
        name="first_name"
        :autofocus="true"
        v-model="modelData.first_name"
        class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
        id="first_name" />
        @if ($errors->has('first_name'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text"
        v-model="modelData.last_name"
        name="last_name"
        class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
        id="last_name" />
        @if ($errors->has('last_name'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
    @endif
</div>



@include('avored-framework::forms.file',['name' => 'image','label' => __('avored-framework::user.file')])

<div class="form-group">
    <label for="email">Email Address</label>
    <input type="text"
        name="email"
        v-model="modelData.email"
        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
        id="email" />
        @if ($errors->has('email'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>



@if(!isset($model))


    <div class="form-group">
        <label for="password">Password</label>
        <input
            type="password"
            name="password"
            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
            id="password" />
            @if ($errors->has('password'))
            <span class='invalid-feedback'>
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input
            type="password"
            name="password_confirmation"
            class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
            id="password_confirmation" />
            @if ($errors->has('password_confirmation'))
            <span class='invalid-feedback'>
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>


@endif

<div class="form-group">
    <label for="role_id">User Role</label>
    <select
        name="role_id"
        v-model="modelData.role_id"
        class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}"
        id="role_id"
    >
        @foreach ($roles as $role)
            <option value="">Please Select</option>
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
        @if ($errors->has('role_id'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('role_id') }}</strong>
        </span>
    @endif
</div>
