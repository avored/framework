
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
    <label for="code">Currency code</label>
    <select
        name="code"
        v-model="modelData.code"
        class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}"
        id="code"
    >
        @foreach ($codeOptions as $codeOption)
            <option value="{{ $codeOption['id'] }}">{{ $codeOption['name'] }}</option>
        @endforeach
    </select>
        @if ($errors->has('code'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('code') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="symbol">Currency Symbol</label>
    <select
        name="symbol"
        v-model="modelData.symbol"
        class="form-control {{ $errors->has('symbol') ? ' is-invalid' : '' }}"
        id="symbol"
    >
        @foreach ($symbolOptions as $symbolOption)
            <option value="{{ $symbolOption['id'] }}">{{ $symbolOption['name'] }}</option>
        @endforeach
    </select>
        @if ($errors->has('symbol'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('symbol') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="conversion_rate">Conversion Rate</label>
    <input type="text"
        name="conversion_rate"
        v-model="modelData.conversion_rate"
        class="form-control {{ $errors->has('conversion_rate') ? ' is-invalid' : '' }}"
        id="conversion_rate" />
        @if ($errors->has('conversion_rate'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('conversion_rate') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select
        name="status"
        v-model="modelData.status"
        class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}"
        id="status"
    >
      <option value="ENABLED">Enabled</option>
      <option value="DISABLED">Disabled</option>
    </select>
        @if ($errors->has('status'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('status') }}</strong>
        </span>
    @endif
</div>
