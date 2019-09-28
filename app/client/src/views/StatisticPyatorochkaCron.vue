<template>
	<div>

		<div class="hello" ref="chartdiv"></div>

  	</div>
</template>

<script>

	import * as am4core from "@amcharts/amcharts4/core";
	import * as am4charts from "@amcharts/amcharts4/charts";
	import am4themes_animated from "@amcharts/amcharts4/themes/animated";

	am4core.useTheme(am4themes_animated);

	export default {

		name: 'StatisticPyatorochkaCron',
		data: function() {
			return {
				statistics: []
			};
		},
		methods: {

			generateData () {

				// query user auth
				axios.get(
					this.$root.api.API_BASEURL +
					this.$root.api.API_PYATEROCHKA_STATISTICSWEEK,
				)
				.then(response => {

					if(response.data.status === 'successfully') {

						this.statistics.push(...response.data.statistics);
						this.statistics.forEach((statistic, key) => {
							this.statistics[key].date = new Date(statistic.date*1000);
						});

					}

				});
					
			}

		},
		computed: {

			renderStatistics () {

				console.log ("update", this.statistics);

				let chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);

				// Add data
				chart.data = this.statistics;

				// Create axes
				let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
				dateAxis.renderer.minGridDistance = 50;

				let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

				// Create series
				let series = chart.series.push(new am4charts.LineSeries());
				series.dataFields.valueY = "visits";
				series.dataFields.dateX = "date";
				series.strokeWidth = 2;
				series.minBulletDistance = 10;
				series.tooltipText = "{valueY}";
				series.tooltip.pointerOrientation = "vertical";
				series.tooltip.background.cornerRadius = 20;
				series.tooltip.background.fillOpacity = 0.5;
				series.tooltip.label.padding(12,12,12,12)

				// Add scrollbar
				chart.scrollbarX = new am4charts.XYChartScrollbar();
				chart.scrollbarX.series.push(series);

				// Add cursor
				chart.cursor = new am4charts.XYCursor();
				chart.cursor.xAxis = dateAxis;
				chart.cursor.snapToSeries = series;

				this.chart = chart;

			}

		},
		beforeDestroy() {
			if (this.chart) {
			this.chart.dispose();
			}
		},
		mounted () {
			this.generateData();
		},
		watch: {
			statistics () {
				this.renderStatistics;
			}
		}


	}

</script>

<style scoped>
.hello {
  width: 100%;
  height: 500px;
  background: #ffffff;
}
</style>