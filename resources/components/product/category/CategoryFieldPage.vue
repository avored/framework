<script>

import isNil from 'lodash/isNil';

export default {
    data() {
        return {
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
        openAllCard() {
            if (this.linkTitle.basic === true || this.linkTitle.seo === true) {
                return false;
            }
            return true;
        }
    }
}
</script>
