<script>
import { Pie, mixins } from "vue-chartjs";
const { reactiveProp } = mixins;
import ChartDataLabels from "chartjs-plugin-datalabels";

export default {
  extends: Pie,

  mixins: [reactiveProp],

  props: ["options"],

  mounted() {
    this.renderChart(this.chartData, this.options);
  }
};
</script>