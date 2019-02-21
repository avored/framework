<script>
export default {

    data() {
        return {
            email: ''
        }
    },
     computed: {
        isSubmitButtonDisbled: function() {
            if(this.email != "") {
                return false;
            }
            return true;
        }
    }
}
</script>
