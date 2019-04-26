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
  props: ['languages', 'baseUrl'],
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
          return this.baseUrl + '/language/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/language/' + record.id;
      },
      deleteRole(record) {
        var url = this.baseUrl  + '/language/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' languages?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.data.success === true) {
                            app.$notification.error({
                                key: 'language.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'language.delete.error',
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
