<script>
import isNil from 'lodash/isNil'

export default {
  data () {
    return {
      loadingSubmitBtn: false
    };
  },
  methods: {
    handleSubmit (e) {
      
      this.loadingSubmitBtn = true;
      this.form.validateFields((err, values) => {
        if (!isNil(err)) {
          this.loadingSubmitBtn = false
          e.preventDefault();
        }
      });
    }
  },
};
</script>
