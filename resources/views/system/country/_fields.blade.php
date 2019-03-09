
<div class="form-group">
    <label for="name">Name</label>
    <input type="text"
        name="name"
        :autofocus="true"
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
    <label for="code">Code</label>
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
    <label for="phone_code">Phone Code</label>
    <input type="text"
        name="phone_code"
        v-model="modelData.phone_code"
        class="form-control {{ $errors->has('phone_code') ? ' is-invalid' : '' }}"
        id="phone_code" />
        @if ($errors->has('phone_code'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('phone_code') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="lang_code">Language Code</label>
    <input type="text"
        name="lang_code"
        v-model="modelData.lang_code"
        class="form-control {{ $errors->has('lang_code') ? ' is-invalid' : '' }}"
        id="lang_code" />
        @if ($errors->has('lang_code'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('lang_code') }}</strong>
        </span>
    @endif
</div>
