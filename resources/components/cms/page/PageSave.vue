<script>
import { quillEditor } from 'vue-quill-editor'
import quill from 'quill'
import Vue from 'vue'
import isNil from 'lodash/isNil'
import { Widget } from './widget'
import { EventBus } from '../../../js/app'

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
        var selection = this.toolbar.quill.getSelection()
        //this.toolbar.quill.insertEmbed(selection.index, 'image', 'http://placehold.it/250x250')
        this.toolbar.quill.insertText(selection.index, '%%%' + this.selectedWidget + '%%%')
        this.toolbar.quill.update()
        this.toolbar.quill.setSelection(selection.index + this.selectedWidget.length + 1)
        this.widgetModalVisible = false
      }
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
      EventBus.$on('widgetClick', toolbar => {
        this.widgetClick(toolbar)
      });
  },
  beforeMount() {
    var icons = quill.import('ui/icons')
    icons['widget'] = '<i class="anticon widget-icon anticon-gold"><svg viewBox="64 64 896 896" data-icon="gold" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class=""><path d="M342 472h342c.4 0 .9 0 1.3-.1 4.4-.7 7.3-4.8 6.6-9.2l-40.2-248c-.6-3.9-4-6.7-7.9-6.7H382.2c-3.9 0-7.3 2.8-7.9 6.7l-40.2 248c-.1.4-.1.9-.1 1.3 0 4.4 3.6 8 8 8zm91.2-196h159.5l20.7 128h-201l20.8-128zm2.5 282.7c-.6-3.9-4-6.7-7.9-6.7H166.2c-3.9 0-7.3 2.8-7.9 6.7l-40.2 248c-.1.4-.1.9-.1 1.3 0 4.4 3.6 8 8 8h342c.4 0 .9 0 1.3-.1 4.4-.7 7.3-4.8 6.6-9.2l-40.2-248zM196.5 748l20.7-128h159.5l20.7 128H196.5zm709.4 58.7l-40.2-248c-.6-3.9-4-6.7-7.9-6.7H596.2c-3.9 0-7.3 2.8-7.9 6.7l-40.2 248c-.1.4-.1.9-.1 1.3 0 4.4 3.6 8 8 8h342c.4 0 .9 0 1.3-.1 4.3-.7 7.3-4.8 6.6-9.2zM626.5 748l20.7-128h159.5l20.7 128H626.5z"></path></svg></i>'   
  }
};
</script>
