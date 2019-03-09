

<div class="form-group">
    <label for="name">Name</label>
    <input type="text"
        name="name"
        v-model="modelData.name"
        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
        id="name" />
        @if ($errors->has('name'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="code">State Code</label>
    <input type="text"
        name="code"
        v-model="modelData.code"
        class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}"
        id="code" />
        @if ($errors->has('code'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('code') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="country_id">Country</label>
    <select
        name="country_id"
        v-model="modelData.country_id"
        class="form-control {{ $errors->has('country_id') ? ' is-invalid' : '' }}"
        id="country_id"
    >
        @foreach ($countryOptions as $country)
            <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
        @endforeach
    </select>
        @if ($errors->has('country_id'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('country_id') }}</strong>
        </span>
    @endif
</div>

