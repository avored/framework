<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::cms.page.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $page->name ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('slug'))
        validate-status="error"
        help="{{ $errors->first('slug') }}"
    @endif
    label="{{ __('avored::cms.page.slug') }}"
>
    <a-input
        :auto-focus="true"
        name="slug"
        v-decorator="[
        'code',
        {'initialValue': '{{ $page->slug ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Slug']) }}' 
                }
            ]
        }
        ]"
    ></a-input>

</a-form-item>

<div class="ant-row ant-form-item">
    <div class="ant-form-item-label">
        <label for="page-content" title="{{ __('avored::cms.page.content') }}">
            {{ __('avored::cms.page.content') }}
        </label>
    </div>
    
    <div class="ant-form-item-control-wrapper">
        <div class="ant-form-item-control">
            <quil-editor id="page-content" :options="editorOption" v-model="content"></quil-editor>
            <input type="hidden" name="content" v-model="content" />
        </div>
    </div>
</div>


<a-form-item
    @if ($errors->has('meta_title'))
        validate-status="error"
        help="{{ $errors->first('meta_title') }}"
    @endif
    label="{{ __('avored::cms.page.meta_title') }}"
>
    <a-input
        :auto-focus="true"
        name="meta_title"
        v-decorator="[
        'meta_title',
        {'initialValue': '{{ $page->meta_title ?? '' }}'},
        {rules: 
            [
                {   required: false, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Meta Title']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>
<a-form-item
    @if ($errors->has('meta_description'))
        validate-status="error"
        help="{{ $errors->first('meta_description') }}"
    @endif
    label="{{ __('avored::cms.page.meta_description') }}"
>
    <a-input
        :auto-focus="true"
        name="meta_description"
        v-decorator="[
        'meta_description',
        {'initialValue': '{{ $page->meta_description ?? '' }}'},
        {rules: 
            [
                {   required: false, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'meta_description']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>


<a-modal
      title="{{__('avored::cms.page.widget_modal_title') }}"
      v-model="widgetModalVisible"
      @ok="handleWidgetOk">
    <div>
        <a-row>
            <a-col :span="24">
                <a-form-item label="{{ __('avored::cms.page.widget_modal_title') }}">
                    <a-select :style="{width: '100%'}" v-model="selectedWidget">
                        @foreach ($widgets as $widgetKey => $widgetLabel)
                            <a-select-option value="{{ $widgetKey }}">{{ $widgetLabel }}</a-select-option>
                        @endforeach
                    </a-select>
                </a-form-item>
            </a-col>
        </a-row>
    
    </div>
      
</a-modal>
