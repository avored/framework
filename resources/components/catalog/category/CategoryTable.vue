<template>
  <div>
    <div>
         <avored-table
            :columns="columns"
            :from="categories.from"
            :to="categories.to"
            :total="categories.total"
            :prev_page_url="categories.prev_page_url"
            :next_page_url="categories.next_page_url"
            :items="categories.data"
            :filerable="true"
            @changeFilter="filterTableData"
        >
          <template slot="name" slot-scope="{item}">
              <a :href="`${baseUrl}/category/${item.id}/edit`" class="text-red-700 hover:text-red-600">
                  {{ item.name }}
              </a>
          </template>
          <template slot="parent" slot-scope="{item}">
              {{ item.parent ? item.parent.name : '' }}
          </template>
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

                <button type="button" 
                  x-data="{ showModal: false }" 
                  x-on:click="showModal = true"
                  data-vue-click-click.prevent="deleteOnClick(item)"
                >
                  <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" x-bind:class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
                      <!--Dialog-->
                      <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" 
                        x-show="showModal" 
                        x-on:click.away="showModal = false" 
                        x-transition:enter="ease-out duration-300" 
                        x-transition:enter-start="opacity-0 scale-90" 
                        x-transition:enter-end="opacity-100 scale-100" 
                        x-transition:leave="ease-in duration-300" 
                        x-transition:leave-start="opacity-100 scale-100" 
                        x-transition:leave-end="opacity-0 scale-90"
                      >

                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                          <p class="text-2xl font-bold">Simple Modal!</p>
                          <div class="cursor-pointer z-50" x-on:click="showModal = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                          </div>
                        </div>

                        <!-- content -->
                        <p>Modal content can go here</p>
                        <p>...</p>
                        <p>...</p>
                        <p>...</p>
                        <p>...</p>

                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                          <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" 
                            x-on:click="showModal = false">
                            Action
                          </button>
                          <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" 
                            x-on:click="showModal = false">
                            Close
                          </button>
                        </div>


                      </div>
                      <!--/Dialog -->
                    </div><!-- /Overlay -->
                  <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
                  </svg>
                </button>
            </div>
          </template>
        </avored-table>
    </div>
  </div>
</template>

<script>

export default {
  props: ['baseUrl', 'initCategories', 'filterUrl'],
  data () {
    return {
        columns: [],
        categories: []
    };
  },
  mounted() {
    this.columns = [
        {
          label: this.$t('system.id'),
          fieldKey: "id",
          visible: true
        },
        {
          label: this.$t('system.parent'),
          slotName: "parent",
          visible: true
        },
        {
          label: this.$t('system.name'),
          slotName: "name",
          visible: true
        },
        {
          label: this.$t('system.slug'),
          fieldKey: "slug",
          visible: true
        },
        {
          label: this.$t('system.meta_title'),
          fieldKey: "meta_title",
          visible: true
        },
        {
          label: this.$t('system.meta_description'),
          fieldKey: "meta_description",
          visible: false
        },
        {
          label: this.$t('system.actions'),
          slotName: "action",
          visible: true
        }
    ];
    this.categories = this.initCategories

  },
  methods: {
      filterTableData(e) {
          let app = this
          var data = {filter: e.target.value}
          axios.post(this.filterUrl, data)
            .then((response) => {
              app.categories = response.data
            })
      },
      getEditUrl(record) {
          return this.baseUrl + '/category/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/category/' + record.id;
      },
      deleteOnClick(record) {
        var url = this.baseUrl  + '/category/' + record.id;
        var app = this;
        this.$confirm({message: this.$t('system.delete_modal_message', {name: record.name, term: this.$t('system.category')}), callback: () => {
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
