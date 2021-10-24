<div x-data="dataFileDnD()" x-init="initFiles('{{ $value }}')" class="relative flex flex-col p-4 text-gray-400 border-2 border-gray-300 border-dashed rounded">
    <div x-ref="dnd"
        class="relative flex flex-col text-gray-400 rounded cursor-pointer">
        <input accept="*" type="file" {{ ($multiple) ? 'multiple' : '' }}
            class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
            name="{{ $name }}"
            @change="addFiles($event)"
            @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
            @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
            @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
            title="" />

        <div class="flex flex-col items-center justify-center py-6 text-center">
            <i class="h-10 w-10" data-feather="image"></i>
            <p class="m-0">Drag your files here or click in this area.</p>
        </div>
    </div>

    <template x-if="files.length > 0">
        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6" @drop.prevent="drop($event)"
            @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
            <template x-for="(_, index) in Array.from({ length: files.length })">
                <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                    style="padding-top: 100%;" @dragstart="dragstart($event)" @dragend="fileDragging = null"
                    :class="{'border-blue-600': fileDragging == index}" draggable="true" :data-index="index">
                    <button class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button"
                        @click="remove(index)">
                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>

                    <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                        x-bind:src="loadFile(files[index])" />
                    <div class="absolute inset-0 z-40 transition-colors duration-300" @dragenter="dragenter($event)"
                        @dragleave="fileDropping = null"
                        :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                    </div>
                </div>
            </template>
        </div>
    </template>
</div>



<script>
function dataFileDnD() {
    return {
        files: [],
        fileDragging: null,
        fileDropping: null,
        humanFileSize(size) {
            const i = Math.floor(Math.log(size) / Math.log(1024));
            return (
                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                " " +
                ["B", "kB", "MB", "GB", "TB"][i]
            );
        },
        initFiles (files) {
            this.files.push(files)

            return
        },

        remove(index) {
            let files = [...this.files];
            files.splice(index, 1);

            this.files = this.createFileList(files);
        },
        drop(e) {
            let removed, add;
            let files = [...this.files];

            removed = files.splice(this.fileDragging, 1);
            files.splice(this.fileDropping, 0, ...removed);

            this.files = this.createFileList(files);

            this.fileDropping = null;
            this.fileDragging = null;
        },
        dragenter(e) {
            let targetElem = e.target.closest("[draggable]");

            this.fileDropping = targetElem.getAttribute("data-index");
        },
        dragstart(e) {
            this.fileDragging = e.target
                .closest("[draggable]")
                .getAttribute("data-index");
            e.dataTransfer.effectAllowed = "move";
        },
        loadFile(file) {
            if (typeof file === 'string') {
                console.log(file)
                return file
            }


            const preview = document.querySelectorAll(".preview");
            var binaryData = []
            binaryData.push(file)
            let blobFile = new Blob(binaryData)
            const blobUrl = window.URL.createObjectURL(blobFile);

            preview.forEach(elem => {
                elem.onload = () => {
                    window.URL.revokeObjectURL(elem.src); // free memory
                };
            });

            return blobUrl;
        },
        addFiles(e) {
            console.log(e.target.files)
            const files = this.createFileList([...e.target.files]);
            this.files = files;
        },
        createFileList() {
            const files = Array.prototype.concat.apply([], arguments)
            let index = 0

            const dataTransfer = new DataTransfer()

            for (; index < files.length; index++) {
                dataTransfer.items.add(files[index])
            }
            return dataTransfer.files
        }
    };

}
</script>
