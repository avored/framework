
<script>

export default {
    data() {
        return {
            collapsed: false,
            isVisible: false,
            leftSideNavMenu: false
        }
    },
    methods: {
        open() {
            console.log('here')
            this.leftSideNavMenu = ! this.leftSideNavMenu
        }
    },
    mounted() {
       
    }
}
</script>
