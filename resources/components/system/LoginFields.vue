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
        if (!err) {
            //axios.post()  
            console.log('Received values of form: ', values);
            console.log(window.x = this.loginForm);
            console.log(window.y = e);
            //e.submit();
            //console.log(this.loginPost);
        } else {
          e.preventDefault();
        }
      });
    }
  },
};
</script>
