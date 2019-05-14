<script>

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
        sorter: true,
    }, 
    {
        title: 'Code',
        dataIndex: 'code',
        key: 'code',
        sorter: true,
    }, 
    {
        title: 'Action',
        key: 'action',
        scopedSlots: { customRender: 'action' },
        sorter: false,
        width: "10%"
    }
];


export default {
  props: ['currencies', 'baseUrl'],
  data () {
    return {
        columns
    };
  },
  methods: {
      getData() {
          return this.currencies;
      },
      getEditUrl(record) {
          return this.baseUrl + '/currency/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/currency/' + record.id;
      },
      deleteCurrency(record) {
        var url = this.baseUrl  + '/currency/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' currency?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'currency.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'currency.delete.error',
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
