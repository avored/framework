<div class="flex w-full mt-3">
    <x-avored::form.input
        name="email"
        value="{{ $subscriber->email ?? '' }}"
        label="{{ __('avored::system.email') }}"
    ></x-avored::form.input>
</div>


<div class="flex w-full mt-3">
    <x-avored::form.select
        name="status"
        value="{{ $subscriber->status ?? '' }}"
        label="{{ __('avored::system.status') }}"
    >
        <option {{ (isset($subscriber) && $subscriber->status === 'ENABLED')  ? 'selected' : ''}} value="ENABLED">
            {{ __('avored::system.enabled') }}
        </option>
        <option {{ (isset($subscriber) && $subscriber->status === 'DISABLED')  ? 'selected' : ''}} value="DISABLED">
            {{ __('avored::system.disabled') }}
        </option>

    </x-avored::form.select>
</div>
