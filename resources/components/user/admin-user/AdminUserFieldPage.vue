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
    },
    mounted() {
        if (!isNil(this.model)) {
            this.modelData = this.model;
        }
    }
}
</script>
