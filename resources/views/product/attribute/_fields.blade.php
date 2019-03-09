
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
    <label for="identifier">Identifier</label>
    <input type="text"
        name="identifier"
        v-model="identifier"
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

$hiddenClass = '';
$editMode = false;

if (isset($model) && $model->attributeDropdownOptions->count() > 0) {
    $editMode = true;
    $hiddenClass = '';
}
?>

<div class="dynamic-field {{ $hiddenClass }}">

    @if($editMode === true)

        @foreach($model->attributeDropdownOptions as $key => $dropdownOptionModel)

            <div class="dynamic-field-row">
                <div class="form-group col-md-12">
                    <label>{{ __('avored-framework::attribute.display-text') }}</label>
                    <span class="input-group">
                        <input class="form-control"
                               name="dropdown_options[{{ $dropdownOptionModel->id }}][display_text]"
                               value="{{ $dropdownOptionModel->display_text }}"/>

                        @if ($loop->last)

                            <div class="input-group-append">
                                <button class="btn btn-primary add-field">Add</button>
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
                    <div class="form-group">

                        <label class="form-control-label" for="display-text-input-group-{{ $randomString }}">
                            {{__('avored-framework::attribute.display-text') }}
                        </label>
                        <div class="input-group">
                            <input class="form-control" id="display-text-input-group-{{ $randomString }}"
                                   name="dropdown_options[{{ $randomString }}][display_text]"/>
                            <div class="input-group-append">
                                <button class="btn btn-primary add-field">Add</button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    @endif

    <div class="dynamic-field-row-template d-none">
        <div class="dynamic-field-row">
            <div class="form-group">
                <label>{{ __('avored-framework::attribute.display-text') }}</label>

                <div class="input-group">
                    <input class="form-control"
                           name="dropdown_options[__RANDOM_STRING__][display_text]"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary add-field">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>


        jQuery(document).ready(function () {

            jQuery(document).on('click', '.add-field', function (e) {

                e.preventDefault();

                var rowTemplate = jQuery('.dynamic-field-row-template').html();
                var randomString = "";
                var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < 5; i++) {
                    randomString += possible.charAt(Math.floor(Math.random() * possible.length));
                }

                rowTemplate = rowTemplate.replace("__RANDOM_STRING__", randomString);

                jQuery(e.target).html('Remove');
                jQuery(e.target).removeClass('add-field');
                jQuery(e.target).addClass('remove-field');
                jQuery(e.target).parents('.dynamic-field-row:first').after(rowTemplate);
            });

            jQuery(document).on('click', '.remove-field', function (e) {

                e.preventDefault();
                jQuery(e.target).parents('.dynamic-field-row:first').remove();

            });
        });

    </script>
@endpush
