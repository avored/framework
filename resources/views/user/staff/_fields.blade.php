<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="first_name"
                autofocus
                value="{{ $staff->first_name ?? '' }}"
                label="{{ __('avored::system.first_name') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="last_name"
                value="{{ $staff->last_name ?? '' }}"
                label="{{ __('avored::system.last_name') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>

<div class="mt-3">
    @if (!isset($staff))
        <x-avored::form.input
            name="email"
            value="{{ $staff->email ?? '' }}"
            label="{{ __('avored::system.email') }}"
        ></x-avored::form.input>
    @else
        <x-avored::form.input
            name="email"
            disabled
            value="{{ $staff->email ?? '' }}"
            label="{{ __('avored::system.email') }}"
        ></x-avored::form.input>
    @endif
</div>


<div class="mt-3">
    <x-avored::form.upload
        name="image_path"
        value="{{ (isset($staff) && isset($staff->imagePath) && $staff->imagePath->url)  ? $staff->imagePath->url : '' }}"
        label="{{ __('avored::system.image_path') }}"
    ></x-avored::form.upload>
</div>


<div class="mt-3">
    <x-avored::form.select
        name="role_id"
        autofocus
        label="{{ __('avored::system.role') }}"
    >
        <option value="">{{ __('avored::system.please_select') }}</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option {{ (isset($staff) && $staff->role_id === $optionValue)  ? 'selected' : ''}} value="{{ $optionValue }}">
                {{ $optionLabel }}
            </option>
        @endforeach

    </x-avored::form.select>
</div>

@if (!isset($staff))
    <div class="flex w-full">
        <div class="w-1/2">
            <div class="mt-3">
                <x-avored::form.input
                    name="password"
                    type="password"
                    label="{{ __('avored::system.password') }}"
                ></x-avored::form.input>
            </div>
        </div>

        <div class="w-1/2 ml-3">
            <div class="mt-3">
                <x-avored::form.input
                    name="confirm_password"
                    type="password"
                    label="{{ __('avored::system.confirm_password') }}"
                ></x-avored::form.input>
            </div>
        </div>
    </div>
@endif
