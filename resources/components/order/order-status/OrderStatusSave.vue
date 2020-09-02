<script>
import isNil from 'lodash/isNil';

export default {
  props: ['orderStatus', 'baseUrl'],
  data () {
    return {
        is_default: ''
    };
  },
  methods: {
      handleSubmit() {
          this.orderStatusForm.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
      },
      isOrderStatusDefaultSwitchChange(checked) {
          if (checked) {
            this.is_default = 1;
          } else {
            this.is_default = 0;
          }
      },
      cancelOrderStatus() {
          window.location = this.baseUrl + '/order-status';
      }
  },
  mounted() {
      if (!isNil(this.orderStatus)) {
        this.is_default = this.orderStatus.is_default;
      }
  }
};
</script>
