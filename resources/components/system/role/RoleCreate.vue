<script>


export default {
  props: ['role', 'baseUrl'],
  data () {
    return {
        roleForm: this.$form.createForm(this)
    };
  },
  methods: {
      handleSubmit() {
        this.roleForm.validateFields((err, values) => {
        if (err) {
          e.preventDefault();
        }
      });
      },
      cancelRole() {
          window.location = this.baseUrl + '/role';
      }
  }
};
</script>
