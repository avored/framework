<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::cms.page.name') }}"
        field-name="name"
        init-value="{{ $page->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::cms.page.slug') }}"
        field-name="slug"
        init-value="{{ $page->slug ?? '' }}" 
        error-text="{{ $errors->first('slug') }}"
    >
    </avored-input>
</div>



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


<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::cms.page.meta_title') }}"
        field-name="meta_title"
        init-value="{{ $menuGroup->meta_title ?? '' }}" 
        error-text="{{ $errors->first('meta_title') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::cms.page.meta_description') }}"
        field-name="meta_description"
        init-value="{{ $menuGroup->meta_description ?? '' }}" 
        error-text="{{ $errors->first('meta_description') }}"
    >
    </avored-input>
</div>



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
