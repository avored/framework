<script>

import isNil from 'lodash/isNil';

export default {
    props: ['category'],
    data() {
        return {
            name: '',
            meta_title: '',
            meta_description: '',
            categoryData: {},
            cardBody: {
                basic: true,
                seo: true
            },
            linkTitle: {
                basic: false,
                seo: false
            }
        }
    },
    methods: {
        sanitizeName: function(name) {
            return name.toLowerCase().replace(/\s*$/g, '').replace(/\s+/g, '-');
        },
        toggleCard(type) {

            for (var cardId in this.linkTitle) {
                if(!this.linkTitle.hasOwnProperty(cardId)) continue;
                this.linkTitle[cardId] = false;
                this.cardBody[cardId] = false;
            }

            this.cardBody[type] = !this.cardBody[type];
            this.linkTitle[type] = !this.linkTitle[type];
        },
        openAllCardLink() {
            for (var cardId in this.linkTitle) {
                if(!this.linkTitle.hasOwnProperty(cardId)) continue;

                this.linkTitle[cardId] = false;
                this.cardBody[cardId] = true;
            }
        },
        changeLanguage(event) {
            window.location = event.target.selectedOptions[0].getAttribute('data-url');
        }
    },
    computed: {
        slug() {
            return  this.sanitizeName(this.name);
        },
        openAllCard() {
            if (this.linkTitle.basic === true || this.linkTitle.seo === true) {
                return false;
            }
            return true;
        }
    },
    mounted () {
        this.categoryData = JSON.parse(this.category);

        this.name = isNil(this.categoryData.name) ? '' : this.categoryData.name;
        this.meta_title = this.categoryData.meta_title;
        this.meta_description = this.categoryData.meta_description;
    }
}
</script>
