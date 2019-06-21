<script>
import isNil from 'lodash/isNil';
import isObject from 'lodash/isObject';
import { quillEditor } from 'vue-quill-editor';
import axios from 'axios'

export default {
  props: ['product', 'baseUrl', 'productProperties'],
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
        categories: [],
        property: {},
        productImages: [],
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
      handlePropertyChange(id, val) {
        let propertyValue = ''
        propertyValue = val

        if (isObject(val)) {
          propertyValue = val.target.value
        }
        this.property[id] = propertyValue;
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
      },
      uploadFileChange(file) {
        if (file.file.status == 'done') {
          this.productImages.push(file.file.response.image);
        }
      },
      deleteImage(id) {
        let deleteImageUrl = this.baseUrl + '/product-image/' + id;
        let app = this;
        let imageId = id;
        axios.delete(deleteImageUrl).then(function (result) {
          if (result.data.success) {
            const index = app.productImages.findIndex(image => image.id === imageId);
            app.productImages.splice(index, 1);
          }
        });
      }
  },
  mounted() {
    if (!isNil(this.product)) {
      this.type = this.product.type
      this.description = this.product.description
      this.productProperties.forEach(record => {
        this.property[record.id] = record.property_value
      });
      this.product.images.forEach(record => {
        this.productImages.push(record)
      });

    }
  }
};
</script>
