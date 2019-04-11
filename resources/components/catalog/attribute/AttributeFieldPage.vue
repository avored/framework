<script>

import { isNil, shuffle, slice, join } from 'lodash';

export default {
    props: ['name', 'dropdownOptions'],
    data() {
        return {
          displayTextFields: []
        }
    },
    methods: {
        sanitizeName(name) {
            return name.toLowerCase().replace(/[^A-Za-z0-9?!]/,'').replace(/\s*$/g, '').replace(/\s+/g, '-');
        },
        changeLanguage(event) {
            window.location = event.target.selectedOptions[0].getAttribute('data-url');
        },
        clickDuplicate(index, event) {

            if (event.target.getAttribute('data-action') !== 'remove') {    
                this.displayTextFields.forEach(element => {
                    element.action = "remove";
                    element.buttonLabel = "Remove";
                });
            }
            
            this.addDisplayTextField(index, event);
        },
        getRandomString() {
            return join(slice(shuffle(['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']),0,8), '');
        },
        addDisplayTextField(index = 0, event) {
            
            if (!isNil(event) && event.target.getAttribute('data-action') === 'remove') {
                this.displayTextFields.splice(index, 1);
            } else {
                let randomString = this.getRandomString();
                this.displayTextFields.push({
                    name: 'dropdown_options['+ randomString +'][display_text]',
                    label: 'Display Text',
                    id: 'display-text-input-group-' + randomString,
                    action: 'add',
                    buttonLabel: 'Add',
                    value: ''
                });
            }
        }
    },
    computed: {
        identifier() {
            this.modelData.identifier = this.sanitizeName(this.modelData.name ? this.modelData.name : '');
            return this.modelData.identifier;
        },
    },
    mounted() {
        if (!isNil(this.dropdownOptions)){
            this.dropdownOptions.forEach(element => {
                var label = 'Remove';
                var action = 'remove';

                if (this.displayTextFields.length + 1 === this.dropdownOptions.length) {
                    label = "Add";
                    action = "add"
                }
                this.displayTextFields.push(
                    {
                        name: 'dropdown_options['+ element.id +'][display_text]',
                        label: 'Display Text',
                        action: action,
                        id: 'display-text-input-group-' + element.id,
                        buttonLabel: label,
                        value: element.display_text
                    }
                );
            });
        } else {
            this.addDisplayTextField();
        }
    }
}
</script>
