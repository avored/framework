<script>

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
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
  props: ['baseUrl'],
  data () {
    return {
        columns
    };
  },
  methods: {
      getEditUrl(record) {
          return this.baseUrl + '/tax-group/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/tax-group/' + record.id;
      },
      deleteTaxGroup(record) {
        var url = this.baseUrl  + '/tax-group/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' tax-group?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'tax-group.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'tax-group.delete.error',
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
