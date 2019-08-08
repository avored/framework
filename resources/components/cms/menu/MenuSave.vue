<script>
import isNil from 'lodash/isNil';

export default {
  props: ['propCategories', 'baseUrl'],
  data () {
    return {
        categories: [],
        selected: null,
        menus: [],
        form: this.$form.createForm(this),
        menu_json: ''
    };
  },
  methods: {
      handleSubmit(e) {
        this.form.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
        });
      },
      handleDrop(data) {
        const { index, list, item } = data;
        item.id = new Date().getTime();
        list.splice(index, 0, item)

        this.menu_json = JSON.stringify(this.menus);
        return true
      },
      handleSubMenuDrop(data) {
        const { index, list, item } = data;
    
        item.id = new Date().getTime();
        list.splice(index, 0, item)
        
        this.menu_json = JSON.stringify(this.menus);
        return true
      },
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
      if (!isNil(this.propCategories)) {
        this.propCategories.forEach(ele => this.categories.push(ele));
      }
  }
};
</script>
<style>
.vddl-list, .vddl-draggable {
  position: relative;
}
.vddl-list {
  min-height: 44px;
}
</style>
