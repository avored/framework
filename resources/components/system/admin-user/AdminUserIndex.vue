<script>

const columns = [
    {
        title: 'First Name',
        dataIndex: 'first_name',
        key: 'first_name',
        sorter: true,
    }, 
    {
        title: 'Last Name',
        dataIndex: 'last_name',
        key: 'last_name',
        sorter: true,
    }, 
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
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
  props: ['adminUsers', 'baseUrl'],
  data () {
    return {
        columns
    };
  },
  methods: {
      getData() {
          return this.languages;
      },
      getEditUrl(record) {
          return this.baseUrl + '/admin-user/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/admin-user/' + record.id;
      },
      deleteRole(record) {
        var url = this.baseUrl  + '/admin-user/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' admin-user?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'admin.user.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'admin.user.delete.error',
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
