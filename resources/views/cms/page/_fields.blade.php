<div class="flex w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $page->name ?? ''
    ])
</div>
<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'slug',
        'label' => __('avored::system.slug'),
        'value' => $page->slug ?? ''
    ])
</div>


<div class="mt-3">
    <div class="">
        <label class="block text-sm leading-5 text-gray-500" 
            for="page-content" title="{{ __('avored::system.content') }}">
            {{ __('avored::system.content') }}
        </label>
    </div>
    
    <div
        x-data="avoredEditor()" 
        x-init="initEditor('{{ $page->content ?? '' }}')" 
        class="mt-1">
        <textarea id="content"></textarea>
        <input type="hidden" name="content" x-model="value" />


    </div>
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'meta_title',
        'label' => __('avored::system.meta_title'),
        'value' => $page->meta_title ?? ''
    ])
</div>
<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'meta_description',
        'label' => __('avored::system.meta_description'),
        'value' => $page->meta_description ?? ''
    ])
</div>


<avored-modal modal-title="{{__('avored::system.widget_modal_title') }}" 
    x-on:close="widgetModalVisible=false" 
    x-bind:is-visible="widgetModalVisible || false">
    <div class="block z-30">
        <avored-select
            label-text="Please Select Widget"
            field-name="selected_widget"
            x-model="selectedWidget"
            x-bind:options="{{ $widgets }}"
        >
        </avored-select>
        <div class="mt-3 py-3">
            <button type="button" x-on:click="handleWidgetOk"
                class="px-3 py-2 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
            >   
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 inline-flex w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                </svg>
                <span class="ml-3">{{ __('avored::system.save') }}</span>
            </button>
        </div>
    
    </div>
</avored-modal>
