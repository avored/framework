<script>
import isNil from 'lodash/isNil';

export default {
  props: ['propCategories', 'baseUrl', 'propMenus', 'menuGroup', 'propFrontMenus'],
  data () {
    return {
        categories: [],
        frontMenus: [],
        selected: null,
        menus: [],
        menu_json: '',
        fields: ['name', 'identifier']
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
      deleteOnClick(menu, submenu = false) {
        const index = this.menus.findIndex((tmpMenu) => {
          if (submenu === true) {
            const submenuIndex = tmpMenu.submenus.findIndex((tmpSubmenu) => {
              return tmpSubmenu.id === menu.id
            })
            tmpMenu.submenus.splice(submenuIndex, 1)
          } else {
            return tmpMenu.id === menu.id
          }
          
        })
        if (index !== -1) {
          this.menus.splice(index, 1)
        }
      },
      cancelMenu() {
        location =  this.baseUrl + '/menu-group/';
      }
  },
  mounted() {
      if (!isNil(this.page)) {
        this.content = this.page.content;
      }
      if (!isNil(this.propCategories)) {
        this.propCategories.forEach(ele => this.categories.push(ele));
      }
      if (!isNil(this.propFrontMenus)) {
        Object.keys(this.propFrontMenus).forEach(key => {
          this.frontMenus.push(this.propFrontMenus[key])
        });
      }
      if (!isNil(this.propMenus)) {
        this.propMenus.forEach(ele => {
          this.menus.push(ele)
        });
      }
      if (!isNil(this.menus)) {
        this.menu_json = JSON.stringify(this.menus);
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
