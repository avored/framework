
<div class="form-group">
    <label for="name">Name</label>
    <input type="text"
        name="name"
        :autofocus="true"
        value="{{ isset($attribute) ? $attribute->getName() : '' }}"
        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
        id="name" />
        @if ($errors->has('name'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>


<div class="form-group">
    <label for="identifier">Identifier</label>
    <input type="text"
        name="identifier"
        value="{{ isset($attribute) ? $attribute->getIdentifier() : '' }}"
        class="form-control {{ $errors->has('identifier') ? ' is-invalid' : '' }}"
        id="identifier" />
        @if ($errors->has('identifier'))
        <span class='invalid-feedback'>
            <strong>{{ $errors->first('identifier') }}</strong>
        </span>
    @endif
</div>

<div class="dynamic-field">
    <div class="card mb-3">
        <div class="card-body">
            <div class="dynamic-field-row">
                <div class="form-group" v-for="(displayTextField, index) in displayTextFields">
                    <label class="form-control-label" :for="displayTextField.id">
                        @{{ displayTextField.label }}
                    </label>
                    <div class="input-group">
                        <input
                            class="form-control"
                            v-model="displayTextField.value"
                            :id="displayTextField.id"
                            :name="displayTextField.name"
                        />
                        <div class="input-group-append">
                            <button
                                type="button"
                                @click="clickDuplicate(index, $event)"
                                :data-action="displayTextField.action"
                                class="btn btn-primary add-field">
                                @{{ displayTextField.buttonLabel }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
