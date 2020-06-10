<script>

export default {
  props: ['category', 'baseUrl'],
  data () {
    return {
        
    };
  },
  methods: {
      
      cancelCategory() {
          window.location = this.baseUrl + '/category';
      }
  }
};
</script>
