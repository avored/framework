
<script>

import isEmpty from 'lodash/isEmpty';

const successNotificationKey = 'success-notification';

export default {
    props: [
        'successNotification'
    ],
    data() {
        return {
            collapsed: false,
        }
    },
    mounted() {
        if (!isEmpty(this.successNotification)){
            this.$alert(this.successNotification)
        }
    }
}
</script>
