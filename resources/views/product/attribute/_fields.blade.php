
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

<?php

$pool = 'abcdefghijklmnopqrstuvwxyz';

$randomString = substr(str_shuffle(str_repeat($pool, 6)), 0, 6);
$editMode = false;

if (isset($attribute) && $attribute->attributeDropdownOptions->count() > 0) {
    $editMode = true;
}
?>

<div class="dynamic-field">
    @if($editMode === true)
        @foreach($attribute->attributeDropdownOptions as $key => $dropdownOptionModel)
            <div class="dynamic-field-row">
                <div class="form-group col-md-12">
                    <label>{{ __('avored-framework::attribute.display-text') }}</label>
                    <span class="input-group">
                        <input class="form-control"
                               name="dropdown_options[{{ $dropdownOptionModel->id }}][display_text]"
                               value="{{ $dropdownOptionModel->getDisplayText() }}"/>

                        @if ($loop->last)
                            <div class="input-group-append">
                                <button 
                                    @click="clickDuplicate"
                                    class="btn btn-primary add-field"
                                >
                                    Add
                                </button>
                            </div>
                        @else
                            <div class="input-group-append">
                                <button class="btn btn-primary remove-field">Remove</button>
                            </div>
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
    @else
        <div class="card mb-3">
            <div class="card-body">
                <div class="dynamic-field-row">
                    <div class="form-group" v-for="displayTextField in displayTextFields">
                        <label class="form-control-label" :for="displayTextField.id">
                            @{{ displayTextField.label }}
                        </label>
                        <div class="input-group">
                            <input
                                class="form-control"
                                :id="displayTextField.id"
                                :name="displayTextField.name"
                            />
                            <div class="input-group-append">
                                <button
                                    type="button"
                                    @click="clickDuplicate"
                                    class="btn btn-primary add-field">
                                    @{{ displayTextField.buttonLabel }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
