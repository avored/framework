<script>
export default {
    data() {
        return {
            menuActive: false
        }
    },
    methods: {
        dropdownSidebarNav() {
            this.menuActive = !this.menuActive;
        }
    }
}
</script>
