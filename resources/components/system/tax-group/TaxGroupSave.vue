<script>
import isNil from 'lodash/isNil';

export default {
  props: ['taxGroup', 'baseUrl'],
  data () {
    return {
       
    };
  },
  methods: {
      handleSubmit() {
         
      },
     
      cancelTaxGroup() {
          window.location = this.baseUrl + '/tax-group';
      }
  },
  mounted() {
  }
};
</script>
