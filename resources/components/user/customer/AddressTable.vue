<template>
    <div class="mt-3">
         <avored-table
            :columns="columns"
            :from="initAddresses.from"
            :to="initAddresses.to"
            :total="initAddresses.total"
            :prev_page_url="initAddresses.prev_page_url"
            :next_page_url="initAddresses.next_page_url"
            :items="initAddresses.data"
        >
          <template slot="action" slot-scope="{item}">
            <div class="flex items-center">
            <a :href="getEditUrl(item)">
              <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                  class="heroicon-ui"
                  d="M6.3 12.3l10-10a1 1 0 011.4 0l4 4a1 1 0 010 1.4l-10 10a1 1 0 01-.7.3H7a1 1 0 01-1-1v-4a1 1 0 01.3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 012 0v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6c0-1.1.9-2 2-2h6a1 1 0 010 2H4v14h14v-6z"
                />
              </svg>
            </a>

            <button type="button" @click.prevent="deleteOnClick(item)">
              <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
              </svg>
            </button>
            </div>
          </template>
        </avored-table>
    </div>
</template>
<script>
export default {
  props: ['baseUrl', 'initAddresses', 'customer'],
  data () {
    return {
        columns: [],    
    };
  },
  mounted() {
      this.columns = [
          {
            label: this.$t('system.id'),
            fieldKey: "id"
          },
          {
            label: this.$t('system.first_name'),
            fieldKey: "first_name"
          },
          {
            label: this.$t('system.last_name'),
            fieldKey: "last_name"
          },
          {
            label: this.$t('system.phone'),
            fieldKey: "phone"
          },
          {
            label: this.$t('system.actions'),
            slotName: "action"
          }
    ];

  },
  methods: {
      getEditUrl(record) {
          return `${this.baseUrl}/customer/${this.customer.id}/address/${record.id}/edit`
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/customer/' + record.id;
      },
      deleteOnClick(record) {
        var url = this.baseUrl  + '/customer/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' customer?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'user.group.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'user.group.delete.error',
                            message: errors.message
                        });
                    });
            },
            onCancel() {
                // Do nothing
            },
        });
    },
  }
};
</script>
