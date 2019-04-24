<script>

export default {
  props: { name:'loginpost', type: String },
  data () {
    return {
      loginForm: this.$form.createForm(this),
    };
  },
  methods: {
    handleSubmit (e) {  
      this.loginForm.validateFields((err, values) => {
        if (err) {
          e.preventDefault();
        }
      });
    }
  },
};
</script>
