<template>
  <div class="mt-3">
    <avored-table
      :columns="columns"
      :from="initOrders.from"
      :to="initOrders.to"
      :total="initOrders.total"
      :prev_page_url="initOrders.prev_page_url"
      :next_page_url="initOrders.next_page_url"
      :items="initOrders.data"
    >
      <template slot="orderUser" slot-scope="{item}">{{ item.user.name }}</template>

      <template slot="action" slot-scope="{item}">
        <div class="flex items-center">
          <a-dropdown>
            <a class="ant-dropdown-link flex" href="#">
              <span>Actions</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-5 text-gray-500"><path class="heroicon-ui" d="M15.3 9.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z"/></svg>
            </a>
            <a-menu slot="overlay">
              <a-menu-item>
                <a :href="orderShowAction(item)">Show</a>
              </a-menu-item>

              <a-menu-item>
                <a @click.prevent="changeStatusMenuClick(item, $event)">Change Status</a>
              </a-menu-item>
              <a-menu-item>
                <a @click.prevent="addTrackingCodeMenuClick(item, $event)">Add Tracking</a>
              </a-menu-item>
              <a-menu-item>
                <a :href="downloadOrderAction(item)">Download Invoice</a>
              </a-menu-item>
              <a-menu-item>
                <a :href="emailInvoiceOrderAction(item)">Email Invoice</a>
              </a-menu-item>
              <a-menu-item>
                <a :href="shippingLabelOrderAction(item)">Shipping Label</a>
              </a-menu-item>
            </a-menu>
          </a-dropdown>
        </div>
      </template>
    </avored-table>
    <a-modal
        title="Change Track Code"
        v-model="track_code_modal_visibility"
        ok-text="Save"
        @cancel="handleTrackCodeCancel"
        @ok="handleTrackCodeOk">
      <avored-input
        label-text="Tracking Code"
        field-name="track_code"
        :init-value="track_code"
        v-model="track_code"
    >
    </avored-input>
    </a-modal>
    <a-modal
      title="Order Status"
      v-model="change_status_modal_visibility"
      @cancel="handleChangeStatusCancel"
      ok-text="Save"
      @ok="handleChangeStatusOk"
    >
      <div class="block">
            <avored-select
                  label-text="Order Status"
                  field-name="order_status_id"
                  :init-value="currentRecord.order_status_id"
                  :options="orderStatuses"
                  v-model="changeStatusId"
            >
            </avored-select>
         
      </div>
    </a-modal>
  </div>
</template>

<script>
const columns = [
  {
    label: "ID",
    fieldKey: "id"
  },
  {
    label: "Shipping Options",
    fieldKey: "shipping_option"
  },
  {
    label: "Payment Options",
    fieldKey: "payment_option"
  },
  {
    label: "User",
    slotName: "orderUser"
  },
  {
    label: "Actions",
    slotName: "action"
  }
];

export default {
  props: ["baseUrl", "initOrders", 'orderStatuses'],
  data() {
    return {
      columns,
      changeStatusId: null,
      track_code: "",
      track_code_modal_visibility: false,
      change_status_modal_visibility: false,
      currentRecord: {},
    };
  },
  methods: {
    orderShowAction(record) {
      return this.baseUrl + "/order/" + record.id;
    },
    handleTrackCodeOk(e) {
      let data = { track_code: this.track_code };

      let url =
        this.baseUrl + "/save-order-track-code/" + this.currentRecord.id;
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
      let data = { order_status_id: this.changeStatusId };

      let url = this.baseUrl + "/order-change-status/" + this.currentRecord.id;
      var app = this;
      axios
        .post(url, data)
        .then(response => {
          if (response.data.success === true) {
            app.$notification.success({
              key: "order.delete.success",
              message: response.data.message
            });
          }
          window.location.reload();
        })
        .catch(errors => {
          app.$notification.error({
            key: "order.delete.error",
            message: errors.message
          });
        });
    }
  }
};
</script>
