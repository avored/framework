<script>

export default {
  props: ['baseUrl'],
  data () {
    return {
        is_default: 1
    };
  },
  methods: {
      cancelUserGroup() {
          window.location = this.baseUrl + '/customer-group';
      }
  },
  mounted() {
      
  }
};
</script>
