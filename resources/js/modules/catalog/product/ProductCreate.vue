<template>
<div class="flex items-center">
    <div class="w-full block">
        <form @submit="handleSubmit"  method="post">
            <div class="mt-3 flex w-full">
                <div class="w-1/2">
                    <avored-input
                        label-text="Name"
                        field-name="name"
                        @input="(value) => product.name = value"
                        error-text=""
                    >
                    </avored-input>
                </div>
                <div class="w-1/2 ml-3">
                    <avored-input
                        label-text="Slug"
                        field-name="slug"
                        @input="(value) => product.slug = value"
                        error-text=""
                    >
                    </avored-input>
                </div>
            </div>

            <div class="mt-3 flex w-full">
                <avored-select
                    label-text="Type"
                    field-name="type"
                    error-text=""
                    @input="(value) => product.type = value"
                    :options="mapTypeOptions(typeOptions)"
                    init-value=""
                >
                </avored-select>
            </div>
            <div class="mt-3 py-3">
                <button type="submit"
                    class="px-6 py-2 font-semibold leading-7  text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 inline-flex w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                    </svg>
                    <span class="ml-3">Save</span>
                </button>

                <a :href="cancelUrl"
                    class="px-6 py-2 font-semibold inline-block text-white leading-7 hover:text-white bg-gray-500 rounded hover:bg-gray-600">
                    <span class="leading-7">
                        Cancel
                    </span>
                </a>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import { useQuery, useClient } from 'villus'
import { ref } from '@vue/composition-api'
import { Provider } from 'villus'
import _ from 'lodash'

export default {
    components: {
        Provider,
    },
    setup() {
        const client = useClient({
            url: "/graphql/admin", // your endpoint.
        });
        var product = ref({})
        const cancelUrl = '/admin/product'
        const mapTypeOptions = (typeOptions) => {
            const options = []
            _.map(_.get(typeOptions, 'value.ProductTypeOptions', []), (option) => {
                options.push(option[option['typeValue']] = option['typeLabel'])
                
            })
            return options
        }
        const productTypeOptions = `
            query {
                ProductTypeOptions {
                    typeValue,
                    typeLabel
                }
            }
        `;
    const { data } = useQuery({
        query: productTypeOptions,
    })
    const queryData = ref(data)
    const typeOptions =  queryData

    const handleSubmit = () => {
        console.log('Call Graphql Product Create Mutation')
    }
        return {
            typeOptions,
            product,
            handleSubmit,
            cancelUrl,
            mapTypeOptions
        }
    }
}
</script>
