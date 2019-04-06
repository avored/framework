<script>

import markdownEditor from 'vue-simplemde/src/markdown-editor';
import multiselect from 'vue-multiselect';
import isNil from 'lodash/isNil';

export default {
    props: ['product'],
    components: {
      markdownEditor,
      multiselect
    },
    data() {
        return {
            category_id: [],
            categories: [],
            cards: {
                basic: true,
                images: false,
                seo: false,
                property: false,
                attribute: false,
                downloadable: false,
                related : false
           }
        }
    },
    methods: {
        isSaveButtonDisabled() {
            return true;
        },
        changeCard(cardType) {
            this.cards[cardType] = !this.cards[cardType];
        },
        categorySelected(value) {
            this.category_id.push({ value: value.id});
        }
    },
    computed: {
        
    },
    mounted() {
        if (! isNil(this.product)) {
            this.categories = this.product.categories;
        }
    }
}
</script>
