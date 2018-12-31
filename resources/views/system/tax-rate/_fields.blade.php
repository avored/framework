@include('avored-framework::forms.text', ['name' => 'name', 'label' => 'Name'])
@include('avored-framework::forms.textarea', ['name' => 'description', 'label' => 'Description'])
@include('avored-framework::forms.select', ['name' => 'country_id', 'label' => 'Country', 'options' => $countryOptions])
@include('avored-framework::forms.select', ['name' => 'state_id', 'label' => 'State', 'options' => []])
@include('avored-framework::forms.text', ['name' => 'postcode', 'label' => 'Postcode'])
@include('avored-framework::forms.text', ['name' => 'rate', 'label' => 'Rate'])
@push('scripts')
    <script>
    
        jQuery(document).ready(function() {
            jQuery(document).on('change', '#country_id', function(e){
                e.preventDefault();

                var url = '{{ url('admin/get-state') }}';
                var data = { country_id: jQuery(this).val(), csrf: '{{ csrf_token() }}' };

                jQuery.ajax({
                    url: url,
                    method: 'post',
                    data: data, 
                    success: function(result) {
                        console.log(result);
                    }
                })
            });
        });
    </script>
@endpush
