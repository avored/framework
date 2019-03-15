<script>

import { isNil, shuffle, slice, join } from 'lodash';

export default {
    props: ['model'],
    data() {
        return {
          modelData: {},
          displayTextFields: []
        }
    },
    methods: {
        sanitizeName(name) {
            return name.toLowerCase().replace(/[^A-Za-z0-9?!]/,'').replace(/\s*$/g, '').replace(/\s+/g, '-');
        },
        clickDuplicate() {
            this.displayTextFields.forEach(element => {
                element.buttonLabel = "Remove";
            });
            this.addDisplayTextField();
        },
        getRandomString() {
            return join(slice(shuffle(['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']),0,8), '');
        },
        addDisplayTextField() {
            let randomString = this.getRandomString();
            this.displayTextFields.push({
                name: 'dropdown_options['+ randomString +'][display_text]',
                label: 'Display Text',
                id: 'display-text-input-group-' + randomString,
                buttonLabel: 'Add'
            });
        }
    },
    computed: {
        identifier() {
            this.modelData.identifier = this.sanitizeName(this.modelData.name ? this.modelData.name : '');
            return   this.modelData.identifier;
        },
    },
    mounted() {
        if (!isNil(this.model)) {
            this.modelData = this.model;
        }
        if (isNil(this.modelData.attribute_dropdown_options)) {
            this.addDisplayTextField();
        }
    }
}
</script>
