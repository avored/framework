<script>
import isNil from 'lodash/isNil';

export default {
  props: ['taxGroup', 'baseUrl'],
  data () {
    return {
        taxGroupForm: this.$form.createForm(this)
    };
  },
  methods: {
      handleSubmit() {
          this.taxGroupForm.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
      },
     
      cancelTaxGroup() {
          window.location = this.baseUrl + '/tax-group';
      }
  },
  mounted() {
  }
};
</script>
