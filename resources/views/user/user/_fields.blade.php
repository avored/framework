
@include('avored-framework::forms.text',['name' => 'first_name' ,'label' => __('avored-framework::user.first-name')])
@include('avored-framework::forms.text',['name' => 'last_name' ,'label' => __('avored-framework::user.last-name')])

@include('avored-framework::forms.text',['name' => 'email' ,'label' => __('avored-framework::user.email')])
@include('avored-framework::forms.text',['name' => 'document' ,'label' => 'CPF/CNPJ'])
@include('avored-framework::forms.text',['name' => 'rg' ,'label' => 'Documento RG'])

@if (!isset($model))

    @include('avored-framework::forms.password',['name' => 'password' ,'label' => __('avored-framework::user.password')])
    @include('avored-framework::forms.password',['name' => 'confirm_password' ,'label' => __('avored-framework::user.confirm-password')])

@endif

<?php
if (isset($model)) {
    $values = $model->userGroups->pluck('id')->toArray();
} else {
    $values = [];
}
?>
@include(
    'avored-framework::forms.select2',
    [
        'name' => 'user_group_id[]' ,
        'label' => __('avored-framework::user.user-group-id'),
        'values' => $values,
        'options'=> $userGroupOptions,
        'attributes' => [
            'multiple' => true,
            'class' => 'form-control select2',
            'id' => 'user_group_id'
        ]
    ]
)

