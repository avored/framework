<script>
import isNil from 'lodash/isNil'

export default {
  props: ['promotionCode', 'baseUrl'],
  data () {
    return {
        status: 0,
        type: null,
        activeFrom: null,
        activeTill: null,
        dateFormat: 'DD-MM-Y',
        activeFromDefault: null,
        activeTillDefault: null,
    };
  },
  methods: {
      handleSubmit() {
          
      },
      onActiveFromChange(val) {
        this.activeFrom = val.format('Y-MM-DD')
      },
      onActiveTillChange(val) {
        this.activeTill = val.format('Y-MM-DD')
      },
      handleTypeChange(val) {
        this.type = val
      },
     
      clickCancelButton() {
          window.location = this.baseUrl + '/promotion-code';
      }
  },
  mounted() {
      if (!isNil(this.promotionCode)) {
        this.status = this.promotionCode.status;
        this.type = this.promotionCode.type;
      }
    
  }
};
</script>
