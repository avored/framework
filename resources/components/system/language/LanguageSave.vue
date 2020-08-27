<script>
import isNil from 'lodash/isNil';

export default {
  props: ['language', 'baseUrl'],
  data () {
    return {
        is_default: 0,
    };
  },
  methods: {
      handleSubmit() {
          this.languageForm.validateFields((err, values) => {
              if (err) {
                e.preventDefault();
              }
          });
      },
      isLanguageDefaultSwitchChange(checked) {
          if (checked) {
            this.is_default = 1;
          } else {
            this.is_default = 0;
          }
      },
      cancelLanguage() {
          window.location = this.baseUrl + '/language';
      }
  },
  mounted() {
      if (!isNil(this.language)) {
          this.is_default = this.language.is_default;
      }
  }
};
</script>
