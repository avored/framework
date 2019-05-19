<script>
import { quillEditor } from 'vue-quill-editor';
import isNil from 'lodash/isNil';

export default {
  props: ['userGroup', 'baseUrl'],
  data () {
    return {
        userGroupForm: this.$form.createForm(this),
        is_default: 1
    };
  },
  methods: {
      handleSubmit() {
          this.userGroupForm.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
      },
      isDefaultSwitchChange(val) {
        if (val) {
          this.is_default = 1;
        } else {
          this.is_default = 0;
        }
      },
      cancelUserGroup() {
          window.location = this.baseUrl + '/user-group';
      }
  },
  mounted() {
      if (!isNil(this.userGroup)) {
        this.is_default = this.userGroup.is_default;
      }
  }
};
</script>
