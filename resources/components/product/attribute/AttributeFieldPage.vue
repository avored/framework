<script>

import isNil from 'lodash/isNil';

export default {
    props: ['model'],
    data() {
        return {
          modelData: {}
        }
    },
    methods: {
        sanitizeName: function(name) {
            return name.toLowerCase().replace(/\s*$/g, '').replace(/\s+/g, '-');
        },
    },
    computed: {
        identifier() {
            this.modelData.identifier = this.sanitizeName(this.modelData.name ? this.modelData.name : '');
            return   this.modelData.identifier;
        },
    },
    mounted() {
        if (!isNil(this.model)) {
            this.modelData = this.model;
        }
    }
}
</script>
