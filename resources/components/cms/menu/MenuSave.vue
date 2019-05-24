<script>
import Draggable from "vuedraggable";
import isNil from 'lodash/isNil';

export default {
  props: ['categories', 'baseUrl'],
  components: {
    'draggable': Draggable,
  },
  data () {
    return {
        list2: []
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
      cancelMenu() {
          window.location = this.baseUrl + '/menu';
      },
      updateMenu(item) {
        console.log(item);
      }
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
  }
};
</script>
