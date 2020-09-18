<div class="border rounded">
    <div class="p-5 text-md font-semibold border-b">
        {{ __('avored::system.property') }}
    </div>
    <div class="p-5">
        @foreach ($properties as $property)
            @php
                $productPropertyValue = $property->getPropertyValueByProductId($product->id);
            @endphp

            @switch($property->field_type)
                @case('SELECT')
                
                    <avored-select
                        label-text="{{ $property->name }}"
                        field-name="property[{{ $property->id }}]"
                        :options="{{ json_encode($property->dropdownOptions->pluck('display_text', 'id')) }}"
                        init-value="{{ $productPropertyValue->value ?? '' }}"
                    ></avored-select>
                
                @break

                @case('TEXT')
                    <avored-input
                        label-text="{{ $property->name }}"
                        field-name="property[{{ $property->id }}]"
                        init-value="{{ $productPropertyValue->value ?? '' }}" 
                        error-text="{{ $errors->first('property.'. $property->id) }}"
                    >
                    </avored-input>
                    
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
    </div>
</div>
