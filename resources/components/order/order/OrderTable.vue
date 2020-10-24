<template>
    <div>
        <avored-table
            :columns="columns"
            :from="orders.from"
            :to="orders.to"
            :total="orders.total"
            :prev_page_url="orders.prev_page_url"
            :next_page_url="orders.next_page_url"
            :items="orders.data"
            :filerable="true"
            @changeFilter="filterTableData"
        >
            <template slot="orderCustomer" slot-scope="{ item }"
                >{{ item.customer.first_name }}
                {{ item.customer.last_name }}</template
            >
            <template slot="orderStatus" slot-scope="{ item }">{{
                item.order_status.name
            }}</template>

            <template slot="action" slot-scope="{ item }">
                <div class="flex items-center">
                    <avored-dropdown>
                        <a class="ant-dropdown-link flex" href="#">
                            <span>Actions</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-5 text-gray-500"
                            >
                                <path
                                    class="heroicon-ui"
                                    d="M15.3 9.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z"
                                />
                            </svg>
                        </a>

                        <template slot="dropdown-content">
                            <div
                                class="relative z-10 mt-2 py-3 w-32 bg-white border border-gray-200"
                            >
                                <a
                                    class="w-full px-3 mb-2 block"
                                    :href="orderShowAction(item)"
                                    >Show</a
                                >
                                <a
                                    href="#"
                                    class="w-full px-3 mb-2 block"
                                    @click.prevent="
                                        changeStatusMenuClick(item, $event)
                                    "
                                >
                                    Change Status
                                </a>
                                <a
                                    href="#"
                                    class="w-full px-3 mb-2 block"
                                    @click.prevent="
                                        addTrackingCodeMenuClick(item, $event)
                                    "
                                >
                                    Add Tracking
                                </a>

                                <a
                                    class="w-full px-3 mb-2 block"
                                    :href="downloadOrderAction(item)"
                                >
                                    Download Invoice
                                </a>

                                <a
                                    class="w-full px-3 mb-2 block"
                                    :href="emailInvoiceOrderAction(item)"
                                >
                                    Email Invoice
                                </a>

                                <a
                                    class="w-full px-3 mb-2 block"
                                    :href="shippingLabelOrderAction(item)"
                                >
                                    Shipping Label
                                </a>
                            </div>
                        </template>
                    </avored-dropdown>
                </div>
            </template>
        </avored-table>

        <avored-modal
            modal-title="Change Track Code"
            @close="track_code_modal_visibility = false"
            :is-visible="track_code_modal_visibility"
        >
            <div class="block">
                <avored-input
                    label-text="Tracking Code"
                    field-name="track_code"
                    :init-value="track_code"
                    v-model="track_code"
                >
                </avored-input>
                <div class="mt-3 py-3">
                    <button
                        type="button"
                        @click="handleTrackCodeOk"
                        class="px-3 py-2 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 inline-flex w-4"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"
                            />
                        </svg>
                        <span class="ml-3">Save</span>
                    </button>

                    <button
                        type="button"
                        @click="handleTrackCodeCancel"
                        class="px-3 py-2 font-xs text-white hover:text-white bg-gray-500 hover:bg-gray-600 rounded"
                    >
                        <span class="">Cancel</span>
                    </button>
                </div>
            </div>
        </avored-modal>

        <avored-modal
            modal-title="Change Order Status"
            @close="change_status_modal_visibility = false"
            :is-visible="change_status_modal_visibility"
        >
            <div class="w-full">
                <avored-select
                    label-text="Order Status"
                    field-name="order_status_id"
                    :init-value="currentRecord.order_status_id"
                    :options="orderStatuses"
                    v-model="changeStatusId"
                >
                </avored-select>
                <div class="mt-3 py-3">
                    <button
                        type="button"
                        @click="handleChangeStatusOk"
                        class="px-3 py-2 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 inline-flex w-4"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"
                            />
                        </svg>
                        <span class="ml-3">Save</span>
                    </button>

                    <button
                        type="button"
                        @click="handleChangeStatusCancel"
                        class="px-3 py-2 font-xs text-white hover:text-white bg-gray-500 hover:bg-gray-600 rounded"
                    >
                        <span class="">Cancel</span>
                    </button>
                </div>
            </div>
        </avored-modal>
    </div>
</template>

<script>
export default {
    props: ["baseUrl", "initOrders", "orderStatuses", 'filterUrl'],
    data() {
        return {
            columns: [],
            changeStatusId: null,
            track_code: "",
            track_code_modal_visibility: false,
            change_status_modal_visibility: false,
            currentRecord: {},
            orders: []
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
                label: this.$t("system.shipping_option"),
                fieldKey: "shipping_option",
                visible: true
            },
            {
                label: this.$t("system.payment_option"),
                fieldKey: "payment_option",
                visible: true
            },
            {
                label: this.$t("system.customer"),
                slotName: "orderCustomer",
                visible: true
            },
            {
                label: this.$t("system.order_status"),
                slotName: "orderStatus",
                visible: true
            },
            {
                label: this.$t("system.actions"),
                slotName: "action",
                visible: true
            }
        ];

        this.orders = this.initOrders
    },
    methods: {
       filterTableData(e) {
            let app = this;
            var data = { filter: e.target.value };
            axios.post(this.filterUrl, data).then(response => {
                app.orders = response.data;
            });
        },
        orderShowAction(record) {
            return this.baseUrl + "/order/" + record.id;
        },
        handleTrackCodeOk(e) {
            let data = { track_code: this.track_code };

            let url =
                this.baseUrl +
                "/save-order-track-code/" +
                this.currentRecord.id;
            var app = this;
            axios
                .post(url, data)
                .then(response => {
                    if (response.data.success === true) {
                        app.$notification.success({
                            key: "save.order.track.code.success",
                            message: response.data.message
                        });
                    }
                    window.location.reload();
                    app.track_code_modal_visibility = false;
                })
                .catch(errors => {
                    app.$notification.error({
                        key: "save.order.track.code.error",
                        message: errors.message
                    });
                });
        },
        changeStatusMenuClick(record, e) {
            e.preventDefault();
            this.currentRecord = record;
            this.change_status = record.order_Status_id;
            this.change_status_modal_visibility = true;
        },
        addTrackingCodeMenuClick(record, e) {
            e.preventDefault();
            this.currentRecord = record;
            this.track_code = record.track_code;
            this.track_code_modal_visibility = true;
        },
        handleTrackCodeCancel() {
            this.track_code_modal_visibility = false;
        },
        handleChangeStatusCancel() {
            this.change_status_modal_visibility = false;
        },
        getShowUrl(record) {
            return this.baseUrl + "/order/" + record.id;
        },
        changeStatusDropdown(val) {
            this.changeStatusId = val;
        },
        downloadOrderAction(record) {
            return this.baseUrl + "/order-download-invoice/" + record.id;
        },
        getOrderStatus(statusId) {
            var index;
            index = this.orderStatus.findIndex(ele => {
                return ele.id === statusId;
            });
            if (index >= 0) {
                return this.orderStatus[index].name;
            }

            return "";
        },
        emailInvoiceOrderAction(record) {
            return this.baseUrl + "/order-email-invoice/" + record.id;
        },
        shippingLabelOrderAction(record) {
            return this.baseUrl + "/order-shipping-label/" + record.id;
        },
        handleChangeStatusOk() {
            let data = { order_status_id: this.changeStatusId[0] };

            let url =
                this.baseUrl + "/order-change-status/" + this.currentRecord.id;
            var app = this;
            axios
                .post(url, data)
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
    }
};
</script>
