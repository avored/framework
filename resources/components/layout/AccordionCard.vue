<script>
export default {
    data() {
        return {
            isActive: false
        }
    },
    methods: {
        dropdownSidebarNav() {
            this.isActive = !this.isActive;
        }
    }
}
</script>
