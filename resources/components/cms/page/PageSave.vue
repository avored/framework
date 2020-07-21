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
        toolbar: null,
        widgetModalVisible: false,
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
