
@include('avored-framework::forms.text',['name' => 'first_name' ,'label' => __('avored-framework::user.first-name')])
@include('avored-framework::forms.text',['name' => 'last_name' ,'label' => __('avored-framework::user.last-name')])


@include('avored-framework::forms.select2',[
                        'name' => 'user_group_id[]' ,
                        'label' => __('avored-framework::user.user-group-id'),
                        'values' => [],
                        'options'=> $userGroupOptions,
                        'attributes' => [
                                'multiple' => true,
                                
                                'class' => 'form-control select2',
                                'id' => 'user_group_id'
                            ]
                        ])


