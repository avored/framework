<script>
import isNil from 'lodash/isNil';

export default {
  props: ['taxGroup', 'baseUrl'],
  data () {
    return {
        taxGroupForm: this.$form.createForm(this),
        is_default: 1
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
      isDefaultSwitchChange(val) {
        if (val) {
          this.is_default = 1;
        } else {
          this.is_default = 0;
        }
      },
      cancelTaxGroup() {
          window.location = this.baseUrl + '/tax-group';
      }
  },
  mounted() {
      if (!isNil(this.taxGroup)) {
        this.is_default = this.taxGroup.is_default;
      }
  }
};
</script>
