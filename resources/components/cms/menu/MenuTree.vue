<script>

import isNil from 'lodash/isNil';
import remove from 'lodash/remove'
import draggable from 'vuedraggable';

export default {
    props: ['menuProps', 'frontMenuProps', 'cateogryProps'],
    components: {
      draggable
    },
    data() {
        return {
            menus: [],
            menuData: [],
            frontMenus: [],
            categories: [],
        }
    },
    methods: {
       destroyMenuFromList(index) {
           console.log(this.menuData.splice(index, 1));
       },
       removeMenu(index) {
           this.menus.splice(index, 1);
       },
       addMenuElement(element) {
            window.x = element;
            let menu = {
                isClone: true,
                name: element.item.getAttribute('data-name'),
                route: element.item.getAttribute('data-route'),
                params: element.item.getAttribute('data-params')
            }
       }
    },
    computed: {
        menuJson() {
            return JSON.stringify(this.menus);
        }
    },
    mounted() {
        if (!isNil(this.menuProps)){
            this.menuData = this.menus = this.menuProps;
        }
        if (!isNil(this.frontMenuProps)){
            this.frontMenus = this.frontMenuProps;
        }
        if (!isNil(this.cateogryProps)){
            this.categories = this.cateogryProps;
        }
    }
}
</script>
