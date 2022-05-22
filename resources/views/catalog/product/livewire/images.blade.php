<div>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
        Small file input
    </label>

    <input
        wire:model.lazy="images"
        id=""
        multiple
        name="images[]"
        class="rounded border border-gray-300 w-full"
        type="file" />

    @error('images')
        <div class="text-red-500 text-sm mt-3">
            {{ $message }}
        </div>
    @enderror


    <button type="button" class="mt-5 text-white px-3 rounded py-2 border bg-red-500" wire:click="uploadImages">
        Upload
    </button>
</div>
