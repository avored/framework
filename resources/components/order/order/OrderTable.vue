<script>

const columns = [
    {
        title: 'Order Id',
        dataIndex: 'id',
        key: 'id',
        sorter: true,
    }, 
    {
        title: 'Customer',
        dataIndex: 'user.name',
        key: 'user.name',
        sorter: true,
    }, 
    {
        title: 'Payment Options',
        dataIndex: 'payment_option',
        key: 'payment_option',
        sorter: true,
    }, 
    {
        title: 'Shipping Options',
        dataIndex: 'shipping_option',
        key: 'shipping_option',
        sorter: true,
    }, 
    {
        title: 'Status',
        dataIndex: 'order_status_id',
        scopedSlots: { customRender: 'order_status' },
        key: 'order_status_id',
        sorter: true,
    }, 
    {
        title: 'Action',
        key: 'action',
        scopedSlots: { customRender: 'action' },
        sorter: false,
        width: "20%"
    }
];

import axios from 'axios'

export default {
    props: ['baseUrl', 'orderStatus'],
    data () {
        return {
            columns,
            changeStatusId: null,
            track_code: '',
            track_code_modal_visibility: false,
            change_status_modal_visibility: false,
            currentRecord: {}
        };
    },
    methods: {
        getShowUrl(record) {
            return this.baseUrl + '/order/' + record.id;
        },
        changeStatusDropdown(val) {
            this.changeStatusId = val;
        },
        downloadOrderAction(record) {
            return this.baseUrl + '/order-download-invoice/' + record.id;
        },
        getOrderStatus(statusId) {
            var index;
            index = this.orderStatus.findIndex(ele => {
                return ele.id === statusId
            })
            if (index >= 0) {
                return this.orderStatus[index].name
            }

            return ''
        },
        emailInvoiceOrderAction(record) {
            return this.baseUrl + '/order-email-invoice/' + record.id;
        },
        shippingLabelOrderAction(record) {
            return this.baseUrl + '/order-shipping-label/' + record.id;
        },
        orderShowAction(record) {
            return this.baseUrl + '/order/' + record.id;
        },
        handleTrackCodeOk(e) {
            let data = {track_code : this.track_code};

            let url = this.baseUrl + '/save-order-track-code/' + this.currentRecord.id;
            var app = this;
            axios.post(url, data)
                .then(response =>  {
                    if (response.data.success === true) {
                        app.$notification.success({
                            key: 'save.order.track.code.success',
                            message: response.data.message,
                        });
                    }
                    window.location.reload();
                    app.track_code_modal_visibility = false;
                })
                .catch(errors => {
                    app.$notification.error({
                        key: 'save.order.track.code.error',
                        message: errors.message
                    });
                });
        },
        changeStatusMenuClick(record, e) {
            e.preventDefault();
            this.currentRecord = record;
            this.change_status = record.order_Status_id
            this.change_status_modal_visibility = true;
        },
        addTrackingCodeMenuClick(record, e) {
            e.preventDefault();
            this.currentRecord = record;
            this.track_code = record.track_code
            this.track_code_modal_visibility = true;
        },
        handleTrackCodeCancel() {
            this.track_code_modal_visibility = false;
        },
        handleChangeStatusCancel() {
            this.change_status_modal_visibility = false;
        },
        handleChangeStatusOk() {
            let data = {order_status_id : this.changeStatusId};

            let url = this.baseUrl + '/order-change-status/' + this.currentRecord.id;
            var app = this;
            axios.post(url, data)
                .then(response =>  {
                    if (response.data.success === true) {
                        app.$notification.success({
                            key: 'order.delete.success',
                            message: response.data.message,
                        });
                    }
                    window.location.reload();
                })
                .catch(errors => {
                    app.$notification.error({
                        key: 'order.delete.error',
                        message: errors.message
                    });
                });
        }
    }
};
</script>
