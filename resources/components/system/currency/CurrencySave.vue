<script>
import isNil from 'lodash/isNil';

export default {
  props: ['currency', 'baseUrl'],
  data () {
    return {
        currencyForm: this.$form.createForm(this),
        status: 0,
        symbol: '',
        code: ''
    };
  },
  methods: {
      handleSubmit() {
          this.currencyForm.validateFields((err, values) => {
              if (err) {
                e.preventDefault();
              }
          });
      },
      isStatusSwitchChange(checked) {
          if (checked) {
            this.status = 1;
          } else {
            this.status = 0;
          }
      },
      handleSymbolSelectChange(value) {
          this.symbol = value;
      },
      handleCodeSelectChange(value) {
          this.code = value;
      },
      cancelCurrency() {
          window.location = this.baseUrl + '/currency';
      }
  },
  mounted() {
      if (!isNil(this.currency)) {
          this.status = this.currency.status;
          this.symbol = this.currency.symbol;
          this.code = this.currency.code;
      }
  }
};
</script>
