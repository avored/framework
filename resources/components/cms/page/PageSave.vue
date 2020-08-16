<script>
import isNil from 'lodash/isNil'
import { Widget } from './widget'
import VueSimplemde from 'vue-simplemde'

 
export default {
  props: ['page', 'baseUrl'],
  components: {
    'vue-simplemde': VueSimplemde
  },
  data () {
    return {
        content: '',
        widgetModalVisible: false,
        selectedWidget: '',
        editor: null,
        widgetModalVisible: false,
        configs: {
          toolbar: [
              'bold',
              'italic',
              'heading', '|', 'quote', 'unordered-list', 'ordered-list',  '|',  'image', 'link', '|', 'table', 'preview', '|', 'side-by-side', 
              {
                name: 'custom',
                action: this.widgetClick,
                className: 'fa fa-star',
                title: 'Widget'
              
              }
            ]
        }
    };
  },
  methods: {
      
      cancelPage() {
          window.location = this.baseUrl + '/page';
      },
      widgetClick(editor) {
          this.editor = editor
          this.widgetModalVisible = true
      },
      handleWidgetOk() {
          var cm = this.editor.codemirror
          var output = '%%%' + this.selectedWidget + '%%%'
          cm.replaceSelection(output)

          this.widgetModalVisible = false
      }
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
    
  },
};
</script>

<style>
  @import '~simplemde/dist/simplemde.min.css';
</style>
