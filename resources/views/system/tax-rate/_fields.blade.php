@include('avored-framework::forms.text', ['name' => 'name', 'label' => 'Name'])
@include('avored-framework::forms.textarea', ['name' => 'description', 'label' => 'Description'])
@include('avored-framework::forms.select', ['name' => 'country_id', 'label' => 'Country', 'options' => $countryOptions])
@include('avored-framework::forms.text', ['name' => 'postcode', 'label' => 'Postcode'])
@include('avored-framework::forms.text', ['name' => 'rate', 'label' => 'Rate'])

