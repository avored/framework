<script>

import isNil from 'lodash/isNil';
import markdownEditor from 'vue-simplemde/src/markdown-editor'

export default {
    props: ['page'],
    components: {
      markdownEditor
    },
    data() {
        return {
         
        }
    },
    methods: {
       changeLanguage(event) {
            window.location = event.target.selectedOptions[0].getAttribute('data-url');
        },
    },
    computed: {
       
    },
    mounted() {
    }
}
</script>
