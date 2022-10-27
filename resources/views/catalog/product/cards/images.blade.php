<div x-data="fileupload" x-init="fileuploadinit">
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
        <input type="file" x-on:change="fileOnChange" name="file_upload" class="hidden">
    </label>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('fileupload', () => ({
            open: false,
         
            fileuploadinit() {
                console.log('init')
            },
            fileOnChange (e) {
                console.log(e.target.files)

                var formData = new FormData();
                formData.append("image", e.target.files[0]);
                axios.post('/admin/product-image/10981be7-ac5b-485a-8ef6-de03584be21e', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(({data}) => {


                })
            }
        }))
    })
</script>

