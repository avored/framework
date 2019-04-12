@php
    $productProperties = $product->getPropertiesAll();
@endphp
<div class="row">
    <div class="col-12">
        <div id="add-property" class="input-group">
            <multiselect
                v-model="properties"
                @select="propertySelected"
                label="name"
                class="input-group-control form-control multiselect"
                :searchable="true"
                track-by="id" 
                :close-on-select="true"
                :clear-on-select="true"
                :preserve-search="false"
                :multiple="true"
                :options="{{ $propertyOptions }}"
            >
                <template slot="tag" slot-scope="{ option }">
                    <span class="multiselect__tag">
                        @{{ option.name }}
                    </span>
                </template>
            </multiselect>
            <div v-for="property in property_id">
                <input type="hidden" name="product_property[]" v-model="property.value" />
            </div>
            <div  class="input-group-append">
                <button type="button"
                        data-token="{ csrf_token() }}"
                        class="btn btn-warning modal-use-selected">
                    Use Selected
                </button>
            </div>

        </div>
        <hr/>
        <div class="property-content-wrapper">

            @if($productProperties->count() > 0 )

                @foreach($productProperties as $productVarcharPropertyValue)

                    @php
                    if(!$productVarcharPropertyValue instanceof \AvoRed\Framework\Models\Database\Property) {
                        $property = $productVarcharPropertyValue->property;
                    } else {
                        $property = $productVarcharPropertyValue;
                    }

                    @endphp

                    @if($property->field_type == 'TEXT')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <input type="text"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   class="form-control"
                                   value="{{ $productVarcharPropertyValue->value }}"
                                   id="property-{{ $property->id }}"/>
                        </div>
                    @endif

                    @if($property->field_type == 'DATETIME')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <input type="text"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   class="form-control datetime"
                                   value="{{ $productVarcharPropertyValue->value }}"
                                   id="property-{{ $property_id }}"/>
                        </div>
                    @endif

                    @if($property->field_type == 'TEXTAREA')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <textarea
                                    name="property[{{ str_random() }}][{{ $property->id  }}]"
                                    class="form-control"
                                    id="property-{{ $property->id }}"
                            >{{ $productVarcharPropertyValue->value }}</textarea>

                        </div>
                    @endif

                    @if($property->field_type == 'SELECT')
                        <div class="form-group">
                            <label for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>

                            <select name="property[{{ str_random() }}][{{ $property->id  }}]"
                                    class="form-control"
                                    id="property-{{ $property->id }}">

                                @foreach($property->propertyDropdownOptions as $option)
                                    <option
                                        value="{{ $option->id }}"

                                        @if($productVarcharPropertyValue->value == $option->id)
                                        selected
                                        @endif
                                    >
                                        {{ $option->display_text }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($property->field_type == 'CHECKBOX')
                        <div class="form-check">
                            <input type="hidden"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   value="0"
                            />
                            <input type="checkbox"
                                   name="property[{{ str_random() }}][{{ $property->id  }}]"
                                   class="form-check-input"
                                   value="1"
                                   @if($productVarcharPropertyValue->value == 1)
                                   checked
                                   @endif
                                   id="property-{{ $property->id }}"
                            />


                            <label class="form-check-label"
                                   for="property-{{ $property->id }}">
                                {{ $property->name }}
                            </label>
                        </div>
                    @endif
                @endforeach
            @else
                <p>Sorry No Property Found assign Yet</p>
            @endif
        </div>
    </div>
</div>
