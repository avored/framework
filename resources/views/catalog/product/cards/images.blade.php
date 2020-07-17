<h1>{{ __('avored::catalog.product.image_title') }}</h1>

<a-upload
    action="{{ route('admin.product.image.upload', $product->id) }}"
    :headers="{'X-CSRF-TOKEN': '{{ csrf_token() }}' }"
    :show-upload-list="false"
    @change="uploadFileChange"
>
    <a-button>
        <a-icon type="upload"></a-icon> {{ __('avored::catalog.product.upload_btn') }}
    </a-button>
</a-upload>

<div class="mt-3" v-for="item in productImages" :key="item.id">

    <div class="flex justify-center items-center">
        <div class="w-1/6">
            <a-avatar :size="64" shape="square"  :src="'/storage/' + item.path"></a-avatar>
        </div>
        <div class="w-2/6">
            <avored-input
                label-text="{{ __('avored::system.fields.alt_text') }}"
                :field-name="'images[' + item.id +'][alt_text]'"
                :init-value="item.alt_text" 
                error-text="{{ $errors->first('alt_text') }}"
            >
            </avored-input>
        </div>
        <div class="w-2/6">
            <input type="radio"
                class="mt-3 ml-5"
                name="is_main_image"
                :checked="item.is_main_image"
                :value="item.id">
            {{ __('Is main image') }}
        </div
        >
        <div class="w-1/6">
            <a-button type="danger" @click="deleteImage(item.id)" icon="delete">
             </a-button>

        </div>
    </div>
</div>
