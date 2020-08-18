<script>

export default {
  props: ['baseUrl'],
  data () {
    return {
    };
  },
  methods: {
      handleSubmit(e) {
           
      },
      cancelConfiguration() {
          window.location = this.baseUrl + '/configuration';
      }
  },
  mounted() {
      
  }
};
</script>
