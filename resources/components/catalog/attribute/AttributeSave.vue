<script>
import isNil from 'lodash/isNil'
import get from 'lodash/get'
let id = 0;

export default {
  props: ['attribute', 'baseUrl'],
  data () {
    return {
        dropdownOptions: [],
        image_path_lists: [],
        headers: {},
        display_as: '',
        fields: ['name', 'slug', 'display_as']
    };
  },
  methods: {
       
        imagePathValue(path) {
            var value = ""
            Object.keys(path).forEach(key => {
                value += path[key]
            })
            return value;
        },
        getInitDropdownValue(index) {
            return get(this.attribute, `dropdown_options.[${index}]['display_text']`, '')
        },
          getInitDropdownPathValue(index) {
            return get(this.attribute, `dropdown_options.[${index}]['path']`, '')
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
            if (true ||isNil(this.attribute)) {
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
            this.dropdownOptions = this.attribute.dropdown_options
        } else {
            this.dropdownOptions.push(this.randomString())
        }
  }
};
</script>
