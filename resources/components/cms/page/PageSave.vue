<script>
import { quillEditor } from 'vue-quill-editor';
import isNil from 'lodash/isNil';

export default {
  props: ['page', 'baseUrl'],
  components: {
    'quil-editor': quillEditor,
  },
  data () {
    return {
        pageForm: this.$form.createForm(this),
        content: ''
    };
  },
  methods: {
      handleSubmit() {
          this.pageForm.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
      },
      cancelPage() {
          window.location = this.baseUrl + '/page';
      }
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
  }
};
</script>
