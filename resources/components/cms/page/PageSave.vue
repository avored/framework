<script>
import { quillEditor } from 'vue-quill-editor'
import quill from 'quill'
import Vue from 'vue'
import isNil from 'lodash/isNil'
import { Widget } from './widget'
// import { EventBus } from '../../../js/app'

 const container = [
      ['bold', 'italic', 'underline', 'strike'],
      [{ header: [1, 2, 3, 4, 5, 6, false] }],
      ['widget']
]
export default {
  props: ['page', 'baseUrl'],
  components: {
    'quil-editor': quillEditor,
  },
  data () {
    return {
        pageForm: this.$form.createForm(this),
        content: '',
        widgetModalVisible: false,
        selectedWidget: '',
        toolbar: null,
        editorOption: {
            modules: {
              toolbar: {
                container: container,
                handlers: {'widget': function() { Widget.click(this) } }
              }
            }
        }
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
      },
      widgetClick(toolbar) {
          this.toolbar = toolbar
          this.widgetModalVisible = true
      },
      handleWidgetOk() {
        // 

        setTimeout(() => {
            // @tood fix this not sure why is this happening here
            var selection = this.toolbar.quill.getSelection()
            if (selection) {
              // this.toolbar.quill.insertEmbed(selection.index, 'image', 'http://placehold.it/250x250')
              this.toolbar.quill.insertText(selection.index, '%%%' + this.selectedWidget + '%%%')
              this.toolbar.quill.update()
              this.toolbar.quill.setSelection(selection.index + this.selectedWidget.length + 1)
             
            }
        }, 200)
        
       
        
         this.widgetModalVisible = false
        
      }
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
      window.EventBus.$on('widgetClick', toolbar => {
        this.widgetClick(toolbar)
      });
  },
  beforeMount() {
    var icons = quill.import('ui/icons')
    icons['widget'] = '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"><path class="heroicon-ui" d="M5 3h4a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5H5zm10-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2V5c0-1.1.9-2 2-2zm0 2v4h4V5h-4zM5 13h4a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4H5zm10-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4c0-1.1.9-2 2-2zm0 2v4h4v-4h-4z"/></svg>'   
  }
};
</script>
