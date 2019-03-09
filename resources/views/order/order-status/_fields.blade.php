

<div class="form-group">
    <label for="name">Name</label>
    <input type="text"
        name="name"
        v-model="modelData.name"
        :autofocus="true"
        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
        id="name" />
        @if ($errors->has('name'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>


<div class="form-group">
    <label for="is_default">Is Default</label>
    <select
        v-model="modelData.is_default"
        name="is_default"
        class="form-control {{ $errors->has('is_default') ? ' is-invalid' : '' }}"
        id="is_default"
    >
        <option value="0">No</option>
        <option value="1">Yes</option>
       
    </select>
        @if ($errors->has('is_default'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('is_default') }}</strong>
        </span>
    @endif
</div>
