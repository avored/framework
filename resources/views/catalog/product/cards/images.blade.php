<div x-data="fileupload" x-init="fileuploadinit({{$product->documents}})">
    <label
        class="flex bg-white justify-center w-full h-32 p-4 transition border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
        <span class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            
            <span class="font-medium text-gray-600">
                Drop files to Attach, or
                <span class="text-blue-600 underline">browse</span>
            </span>
        </span>
        <input type="file" x-on:change="documentOnChange" name="file_upload" class="hidden">
    </label>
    <div class="mt-5">
        <div class="grid gap-4 grid-cols-6">
            <template x-for="document in documents">
                <div class="text-center">
                    <div class="object-fill h-48 w-96">
                        <img x-bind:src="`/storage/${document.path}`" class="w-32 rounded-md" alt="product image" />
                    </div>
                    <div class="flex mt-3 justify-center w-full" >
                        <a href="#" x-on:click.prevent="documentDelete(document.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-5 text-red-900 h-5">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </template>
            
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('fileupload', () => ({
            documents: [],
         
            fileuploadinit(documents) {
                console.log(documents)
                this.documents = documents
            },
            documentOnChange (e) {
                console.log(e.target.documents)

                var formData = new FormData();
                formData.append("image", e.target.files[0]);
                axios.post('/admin/product-document-upload/10981be7-ac5b-485a-8ef6-de03584be21e', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(({data}) => {
                    this.documents = data.data
                })
            },
            documentDelete(id) {
                axios.delete('/admin/product-document-delete/' + id).then(({data}) => {
                    this.documents = data.data
                })
            }
        }))
    })
</script>

