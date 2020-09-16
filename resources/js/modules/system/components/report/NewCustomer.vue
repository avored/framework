<script>
import { Bar } from 'vue-chartjs'

export default {
    extends: Bar,

    props: {
        customers: {
            type: [Object, Array],
            default: () => ({})
        },
        chartdata: {
            type: Object,
            default: () => ({})
        },
        options: {
            type: Object,
            default: () => ({
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'New Customer Report'
                }
            })
        }
    },
    data() {
        return {
            
        }
    },
    mounted () {
        this.chartdata.labels = []
        this.chartdata.datasets = []
        this.chartdata.datasets.push({
            label: 'New Customers',
            data: [],
            fill: false,
            borderColor: '#2554FF',
            backgroundColor: '#2554FF',
            borderWidth: 1  
        })
      
        
        for (const label in this.customers) {
            this.chartdata.labels.push(label)
            this.chartdata.datasets[0].data.push(this.customers[label].length)
        }
        this.renderChart(this.chartdata, this.options)
    }
}
</script>
