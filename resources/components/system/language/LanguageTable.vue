<script>
import isNil from 'lodash/isNil'

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
      handleTableChange(pagination, filters, sorter) {
        this.languages.sort(function(a, b){
            let columnKey = sorter.columnKey
            let order = sorter.order
            
            if (isNil(a[columnKey])) {
                a[columnKey] = ''
            }
            if (isNil(b[columnKey])) {
                b[columnKey] = ''
            }
            if (order === 'ascend'){
                if(a[columnKey] < b[columnKey]) return -1;
                if(a[columnKey] > b[columnKey]) return 1;
            }
            if (order === 'descend') {
                if(a[columnKey] > b[columnKey]) return -1;
                if(a[columnKey] < b[columnKey]) return 1;
            }
            return 0;
        });
      },
      getEditUrl(record) {
          return this.baseUrl + '/language/' + record.id + '/edit';
      },
      getDeleteUrl(record) {
          return this.baseUrl + '/language/' + record.id;
      },
      deleteLanguage(record) {
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
