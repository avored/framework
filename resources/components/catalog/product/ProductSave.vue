<script>
import isNil from 'lodash/isNil';
import isObject from 'lodash/isObject';
import { quillEditor } from 'vue-quill-editor';
import axios from 'axios'

const columns = [{
  dataIndex: 'name',
  key: 'name',
  title: 'Name',
  scopedSlots: { customRender: 'name' },
}, {
  title: 'Price',
  dataIndex: 'price',
  key: 'price',
  scopedSlots: { customRender: 'price' },
}, {
  title: 'Qty',
  dataIndex: 'qty',
  key: 'qty',
  scopedSlots: { customRender: 'qty' },
}, {
  title: 'Action',
  key: 'action',
  scopedSlots: { customRender: 'action' },
}];

export default {
  props: ['product', 'baseUrl', 'productProperties', 'productAttributes', 'productVariations'],
  components: {
    'quil-editor': quillEditor,
  },
  data () {
    return {
        productForm: this.$form.createForm(this),
        variationForm: this.$form.createForm(this),
        type: null,
        headers: {},
        description: null,
        status: 0,
        track_stock: 0,
        is_taxable: 0,
        categories: [],
        property: {},
        productImages: [],
        attributeIds: [],
        variationUploadImagePath: '',
        variationImageList: {},
        columns,
        variationModelVisible: false,
        variationFields: ['id', 'name', 'slug', 'barcode', 'sku', 'qty', 'price', 'weight', 'length', 'width', 'height']
    };
  },
  methods: {
      handleUploadImageChange() {

      },
      clickVariationSave(e) {
         this.variationForm.validateFields((err, data) => {
          if (isNil(err)) {
              let url = this.baseUrl + '/variation/'+ this.product.id +'/save-variation';
              var app = this;
              
              axios.post(url, data)
                .then(res => {
                  if (res.data.success) {
                    app.$notification.success({
                        key: 'product.save.variation.success',
                        message: res.data.message,
                    });
                    window.location.reload();
                  } else {
                    alert('there is an error')
                  }
                })
            }
          });
      },
      deleteVariation(model) {
        let url = this.baseUrl + '/variation/' + model.variation_id;
        var app = this;
        axios.delete(url)
          .then(res => {
            if (res.data.success) {
              app.$notification.success({
                  key: 'product.delete.variation.success',
                  message: res.data.message,
              });
              window.location.reload();
            } else {
              alert('there is an error')
            }
          })
              
      },
      getVariationUploadAction() {

      },
      editVariationModel(model) {
        this.variationModelVisible = true;
        var variationModel = model.variation;

        this.variationFields.forEach(field => {
          this.variationForm.getFieldDecorator(field, {initialValue: variationModel[field]})
          
        });
        this.variationUploadImagePath = this.baseUrl + '/product-image/' + variationModel.id + '/upload';

        if (!isNil(variationModel.images[0])) {
          var fileName = variationModel.images[0].path.replace(/^.*[\\\/]/, '')
          this.variationImageList = [{
            uid: variationModel.images[0].id,
            name: fileName,
            status: 'done',
            url: '/storage/' + variationModel.images[0].path,
          }];
        } else {
          this.variationImageList = [];
        }
        
      },
      handleSubmit(e) {
        this.productForm.validateFields((err, values) => {
          if (err !== null) {
              e.preventDefault();
          }    
          });
      },
      handleVariationBtnClick(e) {
        let data = { attributes: this.attributeIds};
        let url = this.baseUrl + '/variation/'+ this.product.id +'/create-variation';
        var app = this;
       
        axios.post(url, data)
          .then(res => {
            if (res.data.success) {
              app.$notification.success({
                  key: 'product.create.variation.success',
                  message: res.data.message,
              });
              window.location.reload();
            } else {
              alert('there is an error')
            }
          })
      },
      changeVariation(values) {
        var app = this;
        values.forEach(val => {
          app.attributeIds.push(val)
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
    this.headers = { 'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content};
    if (!isNil(this.product)) {
      this.type = this.product.type
      this.description = this.product.description
      this.productProperties.forEach(record => {
        this.property[record.id] = record.product_value.value
      });
      this.productAttributes.forEach(record => {
        this.attributeIds.push(record.id)
      });
      this.product.images.forEach(record => {
        this.productImages.push(record)
      });

    }
  }
};
</script>
