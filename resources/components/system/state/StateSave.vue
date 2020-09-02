<script>
import isNil from 'lodash/isNil';

export default {
  props: ['state', 'baseUrl'],
  data () {
    return {
        country_id: 0
    };
  },
  methods: {
      handleSubmit() {
          this.stateForm.validateFields((err, values) => {
              if (err) {
                e.preventDefault();
              }
          });
      },
      handleCountrySelectChange(value) {
          this.country_id = value;
      },
      cancelState() {
          window.location = this.baseUrl + '/state';
      }
  },
  mounted() {
      if (!isNil(this.state)) {
          this.country_id = this.state.country_id;
      }
  }
};
</script>
