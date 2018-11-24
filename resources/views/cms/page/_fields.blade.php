
<avored-form-input 
    field-name="name"
    label="{{ __('avored-framework::attribute.name') }}" 
    field-value="{!! $model->name ?? "" !!}" 
    error-text="{!! $errors->first('name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>



<avored-form-input 
    field-name="slug"
    label="{{ __('Slug') }}" 
    field-value="{!! $model->slug ?? "" !!}" 
    error-text="{!! $errors->first('slug') !!}"
    v-on:change="changeModelValue"
   
        >
</avored-form-input>
@php
    $content = (isset($model)) ? $model->getContent() : "";
@endphp
<div class="form-group">
    <label for="content">Content</label>
    <textarea id="content" name="content"
              class="summernote form-control"
    >{{ $content }}</textarea>
</div>

<avored-form-input 
    field-name="meta_title"
    label="{{ __('Meta Title') }}" 
    field-value="{!! $model->meta_title ?? "" !!}" 
    error-text="{!! $errors->first('meta_title') !!}"
    v-on:change="changeModelValue"
   
        >
</avored-form-input>

<avored-form-input 
    field-name="meta_description"
    label="{{ __('Meta Description') }}" 
    field-value="{!! $model->meta_description ?? "" !!}" 
    error-text="{!! $errors->first('meta_description') !!}"
    v-on:change="changeModelValue"
   
        >
</avored-form-input>


<div class="modal" id="widget-list-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Widget Selection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('avored-framework::forms.select',
                            ['name' => 'widget_list',
                            'label' => 'Widget List',
                            'options' => $widgetOptions
                            ])
            </div>
            <div class="modal-footer">
                <button type="button" 
                        id="widget-insert-button" 
                        data-dismiss="modal" 
                        class="btn btn-primary">
                    Insert Widget
                </button>
                <button type="button"   
                    id="widget-close-button" 
                    data-dismiss="modal"
                     class="btn btn-default">    
                     Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        jQuery(document).ready(function() {
          
            
        });
    </script>
@endpush
