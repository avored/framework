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
      cancelCategory() {
          window.location = this.baseUrl + '/category';
      }
  }
};
</script>
