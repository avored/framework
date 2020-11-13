<script>
import isNil from 'lodash/isNil'
import isObject from 'lodash/isObject'
import axios from 'axios'

const columns = [{
  fieldKey: 'name',
  key: 'name',
  label: 'Name',
  slotName: "variableProductName"
}, {
  label: 'Price',
  fieldKey: 'price',
  key: 'price',
  slotName: "variableProductPrice"
}, {
  label: 'Qty',
  fieldKey: 'qty',
  key: 'qty',
  slotName: "variableProductQty"
}, {
  label: 'Action',
  key: 'action',
  slotName: "variableProductAction"
}];

import vueEasyMde from 'vue-easymde'

export default {
  props: ['product', 'baseUrl', 'productProperties', 'productAttributes', 'productVariations'],
  components: {
    'vue-simplemde': vueEasyMde,
  },
  data () {
    return {
        type: null,
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
        variationModel: {},
        variationFields: ['id', 'name', 'slug', 'barcode', 'sku', 'qty', 'price', 'weight', 'length', 'width', 'height']
    };
  },
  methods: {
      handleUploadImageChange() {

      },
      clickVariationSave(e) {
        let url = this.baseUrl + '/variation/'+ this.product.id +'/save-variation';
        var app = this;
        
        axios.post(url, this.variationModel)
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
        this.variationModel = model.variation;

     
        this.variationUploadImagePath = this.baseUrl + '/product-image/' + this.variationModel.id + '/upload';

        if (!isNil(this.variationModel.images[0])) {
          var fileName = this.variationModel.images[0].path.replace(/^.*[\\\/]/, '')
          this.variationImageList = this.variationModel.images[0].path;
        } else {
          this.variationImageList = [];
        }
        
      },
      handleSubmit(e) {
       
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
      
      cancelProduct() {
          window.location = this.baseUrl + '/product';
      },
      uploadFileChange(response) {
        this.productImages.push(response.image_model)
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
