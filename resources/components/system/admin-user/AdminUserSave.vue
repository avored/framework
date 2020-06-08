<script>
import isNil from 'lodash/isNil'
import isEmpty from 'lodash/isEmpty'

export default {
  props: ['adminUser', 'baseUrl', 'token'],
  data () {
    return {
        is_super_admin: 0,
        image_path: '',
        headers: {},
        role_id: 0,
        language: '',
        userImageList: [],
    };
  },
  methods: {
      
      handleUploadImageChange(info) {
          if (info.file.status == "done") {
              this.image_path = info.file.response.path;
          }
      },
      
  },
  mounted() {
      if (!isNil(this.adminUser)) {
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
