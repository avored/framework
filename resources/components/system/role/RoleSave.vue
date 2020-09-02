<script>


export default {
  props: ['role', 'baseUrl'],
  data () {
    return {
        
    };
  },
  methods: {
      handleSubmit() {
       
      },
      cancelRole() {
          window.location = this.baseUrl + '/role';
      },
      onUserPermissionSwitchChange(checked, key) {
        if (checked) {
            let ele = document.getElementById('permissions-' + key);
            ele.value = 1;
        } else {
            let ele = document.getElementById('permissions-' + key);
            ele.value = 0;
        }
      },
  }
};
</script>
