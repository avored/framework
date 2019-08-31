<script>

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
        sorter: true,
    }, 
    {
        title: 'Slug',
        dataIndex: 'slug',
        key: 'slug',
        sorter: true,
    }, 
    {
        title: 'Meta Title',
        dataIndex: 'meta_title',
        key: 'meta_title',
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
          return this.baseUrl + '/product/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/product/' + record.id;
      },
      deleteProduct(record) {
        var url = this.baseUrl  + '/product/' + record.id;
        var app = this;
        this.$confirm({
            title: 'Do you Want to delete ' + record.name + ' product?',
            okType: 'danger',
            onOk() {    
                axios.delete(url)
                    .then(response =>  {
                        if (response.success === true) {
                            app.$notification.error({
                                key: 'product.delete.success',
                                message: response.data.message,
                            });
                        }
                        window.location.reload();
                    })
                    .catch(errors => {
                        app.$notification.error({
                            key: 'product.delete.error',
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
