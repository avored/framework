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
  props: ['states', 'baseUrl'],
  data () {
    return {
        columns
    };
  },
  methods: {
      getData() {
          return this.states;
      },
      getEditUrl(record) {
          return this.baseUrl + '/state/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/state/' + record.id;
      },
      deleteState(record) {
        var url = this.baseUrl  + '/state/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' state?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'state.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'state.delete.error',
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
