<template>
  <div>
    <div class="mt-3">
         <avored-table
            :columns="columns"
            :from="initPromotionCodes.from"
            :to="initPromotionCodes.to"
            :total="initPromotionCodes.total"
            :prev_page_url="initPromotionCodes.prev_page_url"
            :next_page_url="initPromotionCodes.next_page_url"
            :items="initPromotionCodes.data"
        > 
          <template slot="name" slot-scope="{item}">
              <a :href="`${baseUrl}/order-status/${item.id}/edit`" class="text-red-700 hover:text-red-600">
                  {{ item.name }}
              </a>
          </template>
          
          <template slot="action" slot-scope="{item}">
            <div class="flex items-center">
               <avored-button
                icon-type="edit-pencil"
                button-class="px-0"
                html-type="link"
                :link-url="getEditUrl(item)">
              </avored-button>


            <avored-button
              icon-type="trash"
              @click.prevent="deleteOnClick(item)">
            </avored-button>
           
            </div>
          </template>
        </avored-table>
    </div>
  </div>
</template>

<script>

export default {
  props: ['baseUrl', 'initPromotionCodes'],
  data () {
    return {
        columns: [],    
    };
  },
  mounted () {
      this.columns = [
          {
            label: this.$t('system.id'),
            fieldKey: "id"
          },
          {
            label: this.$t('system.name'),
            slotName: "name"
          },
          {
            label: this.$t('system.code'),
            fieldKey: "code"
          },
          {
            label: this.$t('system.active_from'),
            fieldKey: "active_from"
          },
          {
            label: this.$t('system.active_till'),
            fieldKey: "active_till"
          },
          {
            label: this.$t('system.actions'),
            slotName: "action"
          }
    ];

  },
  methods: {
      getEditUrl(record) {
          return this.baseUrl + '/promotion-code/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/promotion-code/' + record.id;
      },
      deleteOnClick(record) {
        var url = this.baseUrl  + '/promotion-code/' + record.id;
        var app = this;
        this.$confirm({message: `Do you Want to delete ${record.name} promotion code?`, callback: () => {
           axios.delete(url)
              .then(response =>  {
                  if (response.data.success === true) {
                      app.$alert(response.data.message)
                  }
                  window.location.reload();
              })
              .catch(errors => {
                  app.$alert(errors.message)
              });
        }})
    },
  }
};
</script>
