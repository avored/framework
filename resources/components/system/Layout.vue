
<script>
import gql from 'graphql-tag'

export default {
    data() {
        return {
            collapsed: false,
        }
    },

    mounted() {
        // let data = this.$apollo.query({
        //     query: gql `query AllCategories {
        //         allCategory { 
        //             id 
        //             name
        //             slug
        //             meta_title
        //             meta_description
        //         }
        //     }`
        // }).then(res => {
        //     console.log(res.data.allCategory);

        // });
    }
}
</script>
