<script>
import isNil from 'lodash/isNil';
let id = 0;

export default {
  props: ['attribute', 'baseUrl'],
  data () {
    return {
        attributeForm: this.$form.createForm(this),
        dropdownOptions: [],
        display_as: ''
    };
  },
  methods: {
        handleSubmit() {
          this.attributeForm.validateFields((err, values) => {
            if (err) {
              e.preventDefault();
            }
          });
         },
        imageSelected(info){
            console.log(info);
        },
        displayAsChange(val) {
            this.display_as = val;
        },
        cancelAttribute() {
            window.location = this.baseUrl + '/attribute';
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
        },
        dropdown_options_image(index) {
            return 'dropdown_option_image[' + index + ']';
        }
  },
  mounted() {
      if (!isNil(this.attribute)) {
          if (this.attribute.dropdown_options.length > 0) {
              this.attribute.dropdown_options.forEach(element => {
                this.dropdownOptions.push(element.id);
                this.attributeForm.getFieldDecorator('dropdown_options['+ element.id +']', { initialValue: element.display_text, preserve: true });
              });
          }
      } else {
          this.dropdownOptions.push(this.randomString());
      }
  }
};
</script>
