<script>
import isNil from 'lodash/isNil';
let id = 0;

export default {
  props: ['attribute', 'baseUrl'],
  data () {
    return {
        attributeForm: this.$form.createForm(this),
        dropdownOptions: [],
        image_path_lists: [],
        headers: {},
        display_as: '',
        fields: ['name', 'slug', 'display_as']
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
        imagePathName(path) {
            var name = "dropdown_option[";
            Object.keys(path).forEach(key => {
                name += key
            })
            name += "][path]";
            return name;
        },
        imagePathValue(path) {
            var value = ""
            Object.keys(path).forEach(key => {
                value += path[key]
            })
            return value;
        },
        handleUploadImageChange(info, record){
            if (info.file.status == "done") {
                var object = {};
                object[record] = info.file.response.path; 
                this.image_path_lists.push(object);
          }
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
        getDefaultFile(record) {
            if (isNil(this.attribute)) {
                return []
            }
            var dropdownOption = this.attribute.dropdown_options[record];
            if (!isNil(dropdownOption) && !isNil(dropdownOption.path)) {
                var filename = dropdownOption.path.replace(/^.*[\\\/]/, '')
                return [{
                    uid: dropdownOption.id,
                    name: filename,
                    status: 'done',
                    url: '/storage/' + dropdownOption.path,
                }];
            }
        },
        dropdownOptionDisplayTextName(index) {
            return 'dropdown_option[' + index + '][display_text]';
        },
        dropdown_options_image(index) {
            return 'dropdown_option_image[' + index + ']';
        }
  },
  mounted() {
      this.headers = { 'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content};
      if (!isNil(this.attribute)) {
        this.display_as = this.attribute.display_as;
        this.fields.forEach(field => {
          this.attributeForm.getFieldDecorator(field, {initialValue: this.attribute[field]})
        });

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
