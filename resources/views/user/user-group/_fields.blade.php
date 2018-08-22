
@include('avored-framework::forms.text',['name' => 'name' ,'label' => __('avored-framework::user.user-group-name')])

<div class="form-check">
    <input type="checkbox" 
            id="is_default"
            value="1"
            @if(isset($model) && $model->is_default == 1)
                checked
            @endif
            name="is_default"
            class="form-check-input"
    />
    <label for="is_default">{{ __('avored-framework::user.is_default') }} </label>
</div>

