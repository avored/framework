<script>
export default {

    data() {
        return {
            email: '',
            password: '',
            confirm_password: ''
        }
    },
     computed: {
        isSubmitDisbled: function() {
            if(this.email != "" && this.password != "" && this.confirm_password != '' 
            && (this.password == this.confirm_password)) {
                return false;
            }
            return true;
        }
    }
}
</script>
