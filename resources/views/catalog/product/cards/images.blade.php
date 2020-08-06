<h1>{{ __('avored::catalog.product.image_title') }}</h1>

{{-- <a-upload
    action="{{ route('admin.product.image.upload', $product->id) }}"
    :headers="{'X-CSRF-TOKEN': '{{ csrf_token() }}' }"
    :show-upload-list="false"
    @change="uploadFileChange"
>
    <a-button>
        <a-icon type="upload"></a-icon> {{ __('avored::catalog.product.upload_btn') }}
    </a-button>
</a-upload> --}}

        <avored-upload
            label-text="{{ __('avored::catalog.product.upload_btn') }}"
            field-name="images"
            @input="uploadFileChange"
            :display-preview="false"
            error-text="{{ $errors->first('images') }}"
            upload-url="{{ route('admin.product.image.upload', ['product' => $product]) }}"
        ></avored-upload>

<div class="mt-3" v-for="item in productImages" :key="item.id">

    <div class="flex justify-center items-center">
        <div class="w-1/6">
            <div class="flex rounded-full border-2 border-red-500 p-px w-16 h-16">
               
                <img :src="`/storage/${item.path}`" alt class="w-full h-full rounded-full" />
            </div>
        </div>
        <div class="w-2/6">
            <avored-input
                label-text="{{ __('avored::system.fields.alt_text') }}"
                :field-name="'images[' + item.id +'][alt_text]'"
                :init-value="item.alt_text" 
                v-model="item.alt_text"
                error-text="{{ $errors->first('alt_text') }}"
            >
            </avored-input>
        </div>
        <div class="w-2/6">
            <input type="radio"
                class="mt-3 ml-5"
                name="is_main_image"
                :checked="item.is_main_image"
                v-model="item.id">
            {{ __('Is main image') }}
        </div
        >
        <div class="w-1/6">
            {{-- <a-button type="danger" @click="deleteImage(item.id)" icon="delete">
             </a-button> --}}

        </div>
    </div>
</div>
