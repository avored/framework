<script>
export default {
  props: ['baseUrl'],
  data () {
    return {
        categoryForm: this.$form.createForm(this),
    };
  },
  methods: {
      handleSubmit() {
        this.categoryForm.validateFields((err, values) => {
        if (err) {
          e.preventDefault();
        }
      });
      },
      cancelLanguage() {
          window.location = this.baseUrl + '/category';
      }
  }
};
</script>
