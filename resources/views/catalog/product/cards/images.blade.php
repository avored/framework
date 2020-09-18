<h1>{{ __('avored::system.image_title') }}</h1>

    <avored-upload
        label-text="{{ __('avored::system.btn.upload') }}"
        field-name="images"
        @input="uploadFileChange"
        :display-preview="false"
        error-text="{{ $errors->first('images') }}"
        upload-url="{{ route('admin.product.image.upload', ['product' => $product]) }}"
    ></avored-upload>

<div class="mt-3 rounded border" v-for="item in productImages" :key="item.id">
    <div class="border-b p-5"> Image List</div>
    <div class="p-5">
        <div class="flex justify-center">
            <div class="w-1/6">
                <div class="rounded-full border-2 border-red-500 w-16 h-16">
                    <img :src="`/storage/${item.path}`" class="w-full h-full rounded-full" />
                </div>
            </div>
            <div class="w-2/6">
                <avored-input
                    label-text="{{ __('avored::system.fields.alt_text') }}"
                    :field-name="`images[${item.id}][alt_text]`"
                    :init-value="item.alt_text" 
                    error-text="{{ $errors->first('alt_text') }}"
                ></avored-input>
            </div>
            <div class="w-2/6">
              
                <input type="radio"
                    class="mt-3 ml-5"
                    name="is_main_image"
                    {{-- v-model="item.is_main_image" --}}
                    :checked="item.is_main_image"
                    :value="item.id"
                    :id="`images[${item.id}][id]`"
                />
                <label :for="`images[${item.id}][id]`">{{ __('Is main image') }}</label>
                <input type="hidden" :name="`images[${item.id}][id]`"  v-model="item.id" />
            </div
            >
            <div class="w-1/6">
                <button type="button" @click="deleteImage(item.id)">
                    <svg class="h-6 w-6" fill="currentColor">
                        <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
                    </svg>
                </button>
                
            </div>
        </div>
    </div>
</div>
