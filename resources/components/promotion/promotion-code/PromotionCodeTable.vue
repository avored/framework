<template>
    <div>
        <avored-table
            :columns="columns"
            :from="promotionCodes.from"
            :to="promotionCodes.to"
            :total="promotionCodes.total"
            :prev_page_url="promotionCodes.prev_page_url"
            :next_page_url="promotionCodes.next_page_url"
            :items="promotionCodes.data"
            :filerable="true"
            @changeFilter="filterTableData"
        >
            <template slot="name" slot-scope="{ item }">
                <a
                    :href="`${baseUrl}/order-status/${item.id}/edit`"
                    class="text-red-700 hover:text-red-600"
                >
                    {{ item.name }}
                </a>
            </template>

            <template slot="action" slot-scope="{ item }">
                <div class="flex items-center">
                    <avored-button
                        icon-type="edit-pencil"
                        button-class="px-0"
                        html-type="link"
                        :link-url="getEditUrl(item)"
                    >
                    </avored-button>

                    <avored-button
                        icon-type="trash"
                        @click.prevent="deleteOnClick(item)"
                    >
                    </avored-button>
                </div>
            </template>
        </avored-table>
    </div>
</template>

<script>
export default {
    props: ["baseUrl", "initPromotionCodes", "filterUrl"],
    data() {
        return {
            columns: [],
            promotionCodes: []
        };
    },
    mounted() {
        this.columns = [
            {
                label: this.$t("system.id"),
                fieldKey: "id",
                visible: true
            },
            {
                label: this.$t("system.name"),
                slotName: "name",
                visible: true
            },
            {
                label: this.$t("system.code"),
                fieldKey: "code",
                visible: true
            },
            {
                label: this.$t("system.active_from"),
                fieldKey: "active_from",
                visible: true
            },
            {
                label: this.$t("system.active_till"),
                fieldKey: "active_till",
                visible: true
            },
            {
                label: this.$t("system.actions"),
                slotName: "action",
                visible: true
            }
        ];

        this.promotionCodes = this.initPromotionCodes;
    },
    methods: {
        filterTableData(e) {
            let app = this;
            var data = { filter: e.target.value };
            axios.post(this.filterUrl, data).then(response => {
                app.pages = response.data;
            });
        },
        getEditUrl(record) {
            return this.baseUrl + "/promotion-code/" + record.id + "/edit";
        },
        getDeleteUrl(record) {
            return this.baseUrl + "/promotion-code/" + record.id;
        },
        deleteOnClick(record) {
            var url = this.getDeleteUrl(record);
            var app = this;
            this.$confirm({
                message: `Do you Want to delete ${record.name} promotion code?`,
                callback: () => {
                    axios
                        .delete(url)
                        .then(response => {
                            if (response.data.success === true) {
                                app.$alert(response.data.message);
                            }
                            window.location.reload();
                        })
                        .catch(errors => {
                            app.$alert(errors.message);
                        });
                }
            });
        }
    }
};
</script>
