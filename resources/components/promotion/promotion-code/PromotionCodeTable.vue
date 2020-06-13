<template>
  <div>
    <div class="flex justify-end mt-3">
      <avored-button 
        button-text="Create"
        html-type="link"
        type="primary"
        icon-type="edit-pencil"
        :link-url="createUrl">
      </avored-button>
    </div>
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
          >
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

import AvoRedButton from '../../system/forms/AvoRedButtton'

const columns = [
  {
    label: "ID",
    fieldKey: "id"
  },
  {
    label: "Name",
    fieldKey: "name"
  },
  {
    label: "Code",
    fieldKey: "code"
  },
  {
    label: "Active From",
    fieldKey: "active_from"
  },
  {
    label: "Actions",
    slotName: "action"
  }
];

export default {
  props: ['baseUrl', 'initPromotionCodes', 'createUrl'],
  components: {
    'avored-button': AvoRedButton
  },
  data () {
    return {
        columns,    
    };
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
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' promotion-code?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'promotion-code.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'promotion-code.delete.error',
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
