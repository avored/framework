<script>


export default {
  props: ['role', 'baseUrl'],
  data () {
    return {
        roleForm: this.$form.createForm(this),
        userPermissionList: {},
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
      },
      onUserPermissionSwitchChange(checked) {
        if (checked) {
          this.is_default = 1;
        } else {
          this.is_default = 0;
        }
      },
  }
};
</script>
