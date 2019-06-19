<script>

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
        sorter: true,
    }, 
    {
        title: 'Is Default',
        dataIndex: 'is_default',
        key: 'is_default',
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
          return this.baseUrl + '/user-group/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/user-group/' + record.id;
      },
      deleteUserGroup(record) {
        var url = this.baseUrl  + '/user-group/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' user-group?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'user-group.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'user-group.delete.error',
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
