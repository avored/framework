<template>
  <div>
    <div v-if="categories.data">
      <avored-table
        :columns="columns"
        :items="categories.data.AllCategories.data"
        :filerable="true"
        :total="categories.data.AllCategories.total"
        :from="categories.data.AllCategories.from"
        :to="categories.data.AllCategories.to"
        :next_page_url="nextPageUrl()"
        :prev_page_url="prevPageUrl()"
        @changeFilter="filterTableData"
      >
        <template v-slot:name="slotProps">
          <a
            :href="`${baseUrl}/category/${slotProps.item.id}/edit`"
            class="text-red-700 hover:text-red-600"
          >
            {{ slotProps.item.name }}
          </a>
        </template>
        <template v-slot:parent="slotProps">
          {{ slotProps.item.parent ? slotProps.item.parent.name : "" }}
        </template>
        <template v-slot:action="slotProps">
          <div class="flex items-center">
            <a :href="getEditUrl(slotProps.item)">
              <svg
                class="h-6 w-6"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path class="heroicon-ui"
                    d="M6.3 12.3l10-10a1 1 0 011.4 0l4 4a1 1 0 010 1.4l-10 10a1 1 0 01-.7.3H7a1 1 0 01-1-1v-4a1 1 0 01.3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 012 0v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6c0-1.1.9-2 2-2h6a1 1 0 010 2H4v14h14v-6z"/>
              </svg>
            </a>

            <button
              type="button"
              @click.prevent="deleteOnClick(slotProps.item)"
            >
              <svg
                class="h-6 w-6"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  class="heroicon-ui"
                  d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"
                />
              </svg>
            </button>
          </div>
        </template>
      </avored-table>
    </div>
  </div>
</template>

<script>
import { useQuery, useClient } from "villus";
import { ref } from "@vue/composition-api";
import { Provider } from "villus";
import _ from "lodash";

export default {
  props: ["initCategories", "filterUrl"],
  components: {
    Provider,
  },
  setup(props, context) {
    const client = useClient({
      url: "/graphql/admin", // your endpoint.
    });
    const baseUrl = "/admin";

    const columns = ref([
      {
        label: "id",
        fieldKey: "id",
        visible: true,
      },
      {
        label: "Parent",
        slotName: "parent",
        visible: true,
      },
      {
        label: "Name",
        slotName: "name",
        visible: true,
      },
      {
        label: "Slug",
        fieldKey: "slug",
        visible: true,
      },
      {
        label: "Meta Title",
        fieldKey: "meta_title",
        visible: true,
      },
      {
        label: "Meta Description",
        fieldKey: "meta_description",
        visible: false,
      },
      {
        label: "Actions",
        slotName: "action",
        visible: true,
      },
    ]);

    const route = context.root.$route;
    const page = _.get(route, "query.page", 1);

    const AdminAllCategories = `
            query {
                AllCategories(page: ${page}) {
                    data {
                        id
                        name
                        slug
                        meta_title
                        meta_description
                        created_at
                        updated_at
                    },
                    total
                    per_page
                    to
                    from
                    has_more_pages
                    current_page
                }
            }
        `;
    const result = useQuery({
      query: AdminAllCategories,
    });
    const categories = ref(result);

    const filterTableData = (e) => {
      let app = this;
      var data = { filter: e.target.value };
      axios.post(this.filterUrl, data).then((response) => {
        app.categories = response.data;
      });
    };

    const getEditUrl = (record) => {
      return baseUrl + "/category/" + record.id + "/edit";
    };

    const getDeleteUrl = (record) => {
      return baseUrl + "/category/" + record.id;
    };

    const deleteOnClick = (record) => {
      var url = baseUrl + "/category/" + record.id;
      var app = this;
      this.$confirm({
        message: this.$t("system.delete_modal_message", {
          name: record.name,
          term: this.$t("system.category"),
        }),
        callback: () => {
          axios
            .delete(url)
            .then((response) => {
              if (response.data.success === true) {
                app.$alert(response.data.message);
              }
              window.location.reload();
            })
            .catch((errors) => {
              app.$alert(errors.message);
            });
        },
      });
    };
    const nextPageUrl = () => {
      if (_.get(categories, "value.data.AllCategories.has_more_pages")) {
        let nextPage =
          _.get(categories, "value.data.AllCategories.current_page", 1) + 1;

        return `${baseUrl}/category?page=${nextPage++}`;
      }

      return null;
    };
    const prevPageUrl = () => {
      if (_.get(categories, "value.data.AllCategories.current_page") > 1) {
        let prevPage =
          _.get(categories, "value.data.AllCategories.current_page", 1) - 1;

        return `${baseUrl}/category?page=${prevPage++}`;
      }

      return null;
    };

    return {
      baseUrl,
      columns,
      categories,
      filterTableData,
      getEditUrl,
      getDeleteUrl,
      deleteOnClick,
      nextPageUrl,
      prevPageUrl,
    };
  },
};
</script>
