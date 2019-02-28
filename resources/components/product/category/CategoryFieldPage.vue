<script>
export default {
    data() {
        return {
            name: '',
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
    }
}
</script>
