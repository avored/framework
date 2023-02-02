@foreach($productProperties as $property)

    @switch($property->field_type)
        @case('SELECT')
            <div class="mt-3">
                <x-avored::form.select
                    name="properties[{{ $property->id }}]"
                    label="{{ $property->name }}"
                >
                    <option value="">{{ __('avored::system.please_select') }}</option>
                    @foreach ($property->getDropdownOptions() as $dropdownOption)
                        <option {{ (isset($product) && $product->categories->contains(Arr::get($dropdownOption, 'value')))  ? 'selected' : ''}} value="{{ Arr::get($dropdownOption, 'value') }}">
                            {{ Arr::get($dropdownOption, 'label') }}
                        </option>
                    @endforeach

                </x-avored::form.select>
            </div>
            @break

    @endswitch

@endforeach