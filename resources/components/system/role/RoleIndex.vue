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
  props: ['roles', 'baseUrl'],
  data () {
    return {
        columns
    };
  },
  methods: {
      getData() {
          return this.roles;
      },
      getEditUrl(record) {
          return this.baseUrl + '/role/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/role/' + record.id;
      },
      deleteRole(record) {
        var url = this.baseUrl  + '/role/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' role?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.success({
                                key: 'role.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'role.delete.error',
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
