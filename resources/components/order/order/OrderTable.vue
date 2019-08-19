<script>

const columns = [
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
    props: ['baseUrl'],
    data () {
        return {
            columns,
            changeStatusId: null
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
        emailInvoiceOrderAction(record) {
            return this.baseUrl + '/order-email-invoice/' + record.id;
        },
        shippingLabelOrderAction(record) {
            return this.baseUrl + '/order-shipping-label/' + record.id;
        },
        onChangeStatus(record) {
            let data = {order_status_id : this.changeStatusId};

            let url = this.baseUrl + '/order-change-status/' + record.id;
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
