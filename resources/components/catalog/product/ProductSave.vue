<script>
import isNil from 'lodash/isNil';
import { quillEditor } from 'vue-quill-editor';

export default {
  props: ['product', 'baseUrl'],
  components: {
    'quil-editor': quillEditor,
  },
  data () {
    return {
        productForm: this.$form.createForm(this),
        type: null,
        description: null,
        status: 0,
        track_stock: 0,
        is_taxable: 0,
        categories: 0
    };
  },
  methods: {
      handleSubmit(e) {
        this.productForm.validateFields((err, values) => {
          if (err !== null) {
              e.preventDefault();
            }
              
          });
      },
      handleTypeChange(val) {
        this.type = val;
      },
      handleStatusChange(val) {
          if (val) {
            this.status = 1;
          } else {
            this.status = 0;
          }
      },
      handleCategoryChange(val) {
            this.categories = val;
      },
      handleTrackStockChange(val) {
          if (val) {
            this.track_stock = 1;
          } else {
            this.track_stock = 0;
          }
      },
      handleIsTaxableChange(val) {
          if (val) {
            this.is_taxable = 1;
          } else {
            this.is_taxable = 0;
          }
      },
      cancelProduct() {
          window.location = this.baseUrl + '/product';
      }
  },
  mounted() {
    if (!isNil(this.product)) {
      this.type = this.product.type
      this.description = this.product.description
    }
  }
};
</script>
