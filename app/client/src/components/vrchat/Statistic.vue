<template>
    <div>

        <div class="analytic uk-card uk-card-default uk-card-body uk-card-solid" ref="chartdiv"></div>

    </div>
</template>

<script>

    import * as am4core from "@amcharts/amcharts4/core";
    import * as am4charts from "@amcharts/amcharts4/charts";
    import am4themes_animated from "@amcharts/amcharts4/themes/animated";

    am4core.useTheme(am4themes_animated);

    export default {

        name: 'Statistic',
        data: function() {
            return {
                statistics: []
            };
        },
        methods: {

            generateData () {

                // query user auth
                axios.post(
                    this.$root.api.API_BASEURL +
                    "world/statistic", {
                        worldId: 'wrld_c5796060-01b4-49af-a555-1ee3a4af8503'
                    }
                )
                    .then(response => {

                        if(response.status === 200) {
                            let statistics = JSON.parse(response.data.data).statistics;
                            this.statistics.push(...statistics);
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

                // Create chart
                let chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);
                chart.paddingRight = 20;

                chart.data = this.statistics;

                let dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.baseInterval = {
                    "timeUnit": "minute",
                    "count": 1
                };
                dateAxis.tooltipDateFormat = "HH:mm, d MMMM";

                let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.tooltip.disabled = true;
                valueAxis.title.text = "Unique visitors";

                let series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.dateX = "date";
                series.dataFields.valueY = "visits";
                series.tooltipText = "Visits: [bold]{valueY}[/]";
                series.fillOpacity = 0.3;


                chart.cursor = new am4charts.XYCursor();
                chart.cursor.lineY.opacity = 0;
                chart.scrollbarX = new am4charts.XYChartScrollbar();
                chart.scrollbarX.series.push(series);


                chart.events.on("datavalidated", function () {
                    dateAxis.zoom({start:0.8, end:1});
                });

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
    .analytic {
        height: 500px;
    }
</style>