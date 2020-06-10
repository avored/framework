<script>
import isNil from 'lodash/isNil';

export default {
  props: ['currency', 'baseUrl'],
  data () {
    return {
        currencyForm: this.$form.createForm(this),
  
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

      cancelCurrency() {
          window.location = this.baseUrl + '/currency';
      }
  },
  mounted() {
     
  }
};
</script>
