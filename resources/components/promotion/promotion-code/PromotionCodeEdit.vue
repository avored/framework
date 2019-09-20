<script>
import { quillEditor } from 'vue-quill-editor'
import isNil from 'lodash/isNil'
import moment from 'moment'

export default {
  props: ['promotionCode', 'baseUrl'],
  data () {
    return {
        form: this.$form.createForm(this),
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
          this.form.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
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
      changeStatus(val) {
        if (val) {
          this.status = 1;
        } else {
          this.status = 0;
        }
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
      if (!isNil(this.promotionCode.active_from)) {
        this.activeFromDefault = moment(this.promotionCode.active_from, 'Y-MM-DD')
        this.activeFrom = this.promotionCode.active_from;
      }
      if (!isNil(this.promotionCode.active_till)) {
        this.activeTillDefault = moment(this.promotionCode.active_till, 'Y-MM-DD')
        this.activeTill = this.promotionCode.active_till;
      }
  }
};
</script>
