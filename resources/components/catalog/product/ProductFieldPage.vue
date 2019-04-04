<script>

import markdownEditor from 'vue-simplemde/src/markdown-editor';
import multiselect from 'vue-multiselect';

export default {
    props: [],
    components: {
      markdownEditor,
      multiselect
    },
    data() {
        return {
            category_id: [],
            category_multiselect_values: [],
        }
    },
    methods: {
        isSaveButtonDisabled() {
            return false;
        },
        categorySelected(value) {
            this.category_id.push(value.id);
        }
    },
    computed: {
        
    },
    mounted() {
    }
}
</script>
