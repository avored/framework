<script>
import isNil from 'lodash/isNil';
let id = 0;

export default {
  props: ['property', 'baseUrl'],
  data () {
    return {
        propertyForm: this.$form.createForm(this),
        use_for_all_products: 0,
        use_for_category_filter: 0,
        is_visible_frontend: 0,
        data_type: '',
        field_type: '',
        dropdownOptions: []
    };
  },
  methods: {
      handleSubmit() {
          this.propertyForm.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
      },
      fieldTypeChange(val) {
          this.field_type = val;
          if (val === 'SELECT' || val === 'RADIO') {
              this.dropdownOptions.push(this.randomString());
          } else {
            this.dropdownOptions = [];
          }
      },
      dataTypeChange(val) {
          this.data_type = val;
      },
      useForAllProductSwitchChange(val) {
        if (val) {
            this.use_for_all_products = 1;
        } else {
            this.use_for_all_products = 0;
        }
      },
      useForCategoryFilterSwitchChange(val) {
        if (val) {
            this.use_for_category_filter = 1;
        } else {
            this.use_for_category_filter = 0;
        }
      },
      isVisibleInFrontendSwitchChange(val) {
        if (val) {
            this.is_visible_frontend = 1;
        } else {
            this.is_visible_frontend = 0;
        }
      },
      cancelProperty() {
          window.location = this.baseUrl + '/property';
      },
      randomString() {
          let random_string = '';
          let random_ascii;
          for(let i = 0; i < 6; i++) {
              random_ascii = Math.floor((Math.random() * 25) + 97);
              random_string += String.fromCharCode(random_ascii)
          }
          return random_string
      },
      dropdownOptionChange(index) {
          if (index == this.dropdownOptions.length - 1) {
              this.dropdownOptions.push(this.randomString());
          } else {
              this.dropdownOptions.splice(index, 1);
          }
          
      },
      dropdown_options(index) {
        return 'dropdown_option[' + index + ']';
      }
  },
  mounted() {
      if (!isNil(this.property)) {
          this.is_visible_frontend = this.property.is_visible_frontend;
          this.use_for_all_products = this.property.use_for_all_products;
          this.data_type = this.property.data_type;
          this.field_type = this.property.field_type;
          
          if (!isNil(this.property.dropdown_options) && this.property.dropdown_options.length > 0) {
              this.property.dropdown_options.forEach(element => {
                this.dropdownOptions.push(element.id);
                this.propertyForm.getFieldDecorator('dropdown_options['+ element.id +']', { initialValue: element.display_text, preserve: true });
              });
          }
      }
  }
};
</script>
