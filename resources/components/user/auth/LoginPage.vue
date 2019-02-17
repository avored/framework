<script>
export default {

    data() {
        return {
            email: '',
            password: ''
        }
    },
     computed: {
        isLoginDisbled: function() {
            if(this.email != "" && this.password != "") {
                return false;
            }
            return true;
        }
    }
}
</script>
