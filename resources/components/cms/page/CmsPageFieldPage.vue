<script>

import isNil from 'lodash/isNil';

export default {
    props: ['page'],
    data() {
        return {
          pageData: {}
        }
    },
    methods: {
        sanitizeName: function(name) {
            return name.toLowerCase().replace(/\s*$/g, '').replace(/\s+/g, '-');
        },
    },
    computed: {
        slug() {
            this.pageData.slug = this.sanitizeName(this.pageData.name ? this.pageData.name : '');
            return  this.pageData.slug;
        },
    },
    mounted() {
        if (!isNil(this.page)) {
            this.pageData = this.page;
        }
    }

}
</script>
