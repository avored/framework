<script>
import isNil from 'lodash/isNil'
import isEmpty from 'lodash/isEmpty'

export default {
  props: ['adminUser', 'baseUrl', 'token'],
  data () {
    return {
        adminUserForm: this.$form.createForm(this),
        is_super_admin: 0,
        image_path: '',
        headers: {},
        role_id: 0,
        language: '',
        userImageList: [],
    };
  },
  methods: {
      handleSubmit() {
          this.adminUserForm.validateFields((err, values) => {
              if (err) {
                e.preventDefault();
              }
          });
      },
      isLanguageDefaultSwitchChange(checked) {
          if (checked) {
            this.is_super_admin = 1;
          } else {
            this.is_super_admin = 0;
          }
      },
      cancelAdminUser() {
          window.location = this.baseUrl + '/admin-user';
      },
      handleUploadImageChange(info) {
          if (info.file.status == "done") {
              this.image_path = info.file.response.path;
          }
      },
      handleRoleChange(value) {
          this.role_id = value;
      },
      handleLanguageChange(value) {
          this.language = value;
      }
  },
  mounted() {
      if (!isNil(this.adminUser)) {
            this.is_super_admin = this.adminUser.is_super_admin;
            this.language = this.adminUser.language;
            this.role_id = this.adminUser.role_id;
            if (!isEmpty(this.adminUser.image_path)) {
                this.userImageList.push({
                    uid: this.adminUser.id,
                    name: this.adminUser.image_path_name,
                    status: 'done',
                    url: this.adminUser.image_path_url
                });
            }
      }
      this.headers = { 'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content};
  }
};
</script>
<style>
  .ant-upload-select-picture-card i {
    font-size: 32px;
    color: #999;
  }

  .ant-upload-select-picture-card .ant-upload-text {
    margin-top: 8px;
    color: #666;
  }
</style>
