
<script>

export default {
    data() {
        return {
            collapsed: false,
            isVisible: false,
            leftSideNavMenu: false,
            sidebar: false
        }
    },
    methods: {
        open() {
            this.leftSideNavMenu = ! this.leftSideNavMenu
        }
    },
    mounted() {
       
    }
}
</script>
