<script>

export default {
  props: ['category', 'baseUrl'],
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
       onChange(checked) {
        if (checked) {
          this.is_default = 1;
        } else {
          this.is_default = 0;
        }
      },
      cancelLanguage() {
          window.location = this.baseUrl + '/category';
      }
  }
};
</script>
