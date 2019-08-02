<a-card class="mt-1 mb-1" title="{{ __('avored::catalog.product.property_card_title') }}">
    @foreach ($properties as $property)
        @php
            $productPropertyValue = $property->getPropertyValueByProductId($product->id);
        @endphp

        @switch($property->field_type)
            @case('SELECT')
            
                <a-form-item label="{{ $property->name }}">
                    <a-select
                        v-on:change="handlePropertyChange({{ $property->id }}, $event)"
                        v-decorator="[
                            'property[{{ $property->id }}]',
                            {{ (isset($property) && isset($productPropertyValue->value)) ? "{'initialValue': " . $productPropertyValue->value . "}," : "" }}
                            {rules:
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => $property->name]) }}' 
                                    }
                                ]
                            }
                        ]">
                            @foreach ($property->dropdownOptions as $dropdownOption)
                                <a-select-option :value="{{ $dropdownOption->id }}">
                                {{ $dropdownOption->display_text }}
                            </a-select-option>
                        @endforeach
                    </a-select>
                </a-form-item>
                <input type="hidden" name="property[{{ $property->id }}]" v-model="property[{{ $property->id }}]" />
            @break

            @case('TEXT')
                <a-form-item label="{{ $property->name }}">
                    <a-input
                        name="property[{{ $property->id }}]"
                        v-decorator="[
                            'property[{{ $property->id }}]',
                            {rules:
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => $property->name]) }}' 
                                    }
                                ]
                            }
                        ]">
                           
                    </a-input>
                </a-form-item>
            @break

            @case('TEXTAREA')
                <a-form-item label="{{ $property->name }}">
                    <a-textarea
                        :rows="4"
                        name="property[{{ $property->id }}]"
                        v-decorator="[
                            'property[{{ $property->id }}]',
                            {rules:
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => $property->name]) }}' 
                                    }
                                ]
                            }
                        ]">
                           
                    </a-textarea>
                </a-form-item>
            @break

            @case('DATETIME')
                <a-form-item label="{{ $property->name }}">
                    <a-date-picker
                        :show-time="true"
                        format="DD-MM-YYYY HH:mm:ss"
                        v-on:change="handlePropertyChange({{ $property->id }}, $event)"
                        v-decorator="[
                            'property[{{ $property->id }}]',
                            {rules:
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => $property->name]) }}' 
                                    }
                                ]
                            }
                        ]">
                    </a-date-picker>
                </a-form-item>
                <input type="hidden" name="property[{{ $property->id }}]" v-model="property[{{ $property->id }}]" />
            @break

            @case('SWITCH')
                <a-form-item label="{{ $property->name }}">
                    <a-switch
                        v-on:change="handlePropertyChange({{ $property->id }}, $event)"
                        v-decorator="[
                            'property[{{ $property->id }}]',
                            {rules:
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => $property->name]) }}' 
                                    }
                                ]
                            }
                        ]">
                    </a-switch>
                </a-form-item>
                <input type="hidden" name="property[{{ $property->id }}]" v-model="property[{{ $property->id }}]" />
            @break

            @case('RADIO')
                <a-form-item label="{{ $property->name }}">
                    <a-radio-group
                        v-on:change="handlePropertyChange({{ $property->id }}, $event)"
                        :options="{{ $property->getDropdownOptions() }}"
                        v-decorator="[
                            'property[{{ $property->id }}]',
                            {'initialValue': {{ $property->property_value}}}, 
                            {rules:
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => $property->name]) }}' 
                                    }
                                ]
                            }
                        ]">
                    </a-radio-group>
                </a-form-item>
                <input type="hidden" name="property[{{ $property->id }}]" v-model="property[{{ $property->id }}]" />
            @break
        @endswitch
    @endforeach    
</a-card>
