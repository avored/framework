<script>

export default {
  props: ['baseUrl'],
  data () {
    return {
        configurationForm: this.$form.createForm(this)
    };
  },
  methods: {
      handleSubmit(e) {
            this.configurationForm.validateFields((err, values) => {
                if (err) {
                    e.preventDefault();
                }
            });
      },
      cancelConfiguration() {
          window.location = this.baseUrl + '/configuration';
      }
  },
  mounted() {
      
  }
};
</script>
