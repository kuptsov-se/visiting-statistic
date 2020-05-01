<template>
    <div class="section has-text-centered">
        <h1 class="title">Visiting Statistic</h1>
        <div class="tile">
            <div class="tile is-6 is-parent" ref="graph">
                <div class="card">
                    <div class="card-content">
                        <graph-bar
                                :width="graphWidth"
                                :height="graphHeight"
                                :axis-min="0"
                                :labels="labels"
                                :values="values">
                            <tooltip :names="names" :position="'right'"></tooltip>
                        </graph-bar>
                    </div>
                </div>
            </div>
            <div class="tile is-6 is-parent">
                <div class="card">
                    <div class="card-content">
                        <table class="table is-striped">
                            <tr class="is-selected">
                                <th>Period</th>
                                <th>Total</th>
                                <th>Unique</th>
                                <th>Undefined IP</th>
                            </tr>
                            <tr>
                                <td>All time</td>
                                <td>{{ totalAllVisits }}</td>
                                <td>{{ totalUniqueVisits }}</td>
                                <td>{{ totalUndefinedIp }}</td>
                            </tr>
                            <tr>
                                <td>Today</td>
                                <td>{{ todayAllVisits }}</td>
                                <td>{{ todayUniqueVisits }}</td>
                                <td>{{ todayUndefinedIp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VisitingStatistic",
        props: [
            'totalAllVisits',
            'totalUniqueVisits',
            'totalUndefinedIp',
            'todayAllVisits',
            'todayUniqueVisits',
            'todayUndefinedIp',
        ],
        data(){
            return {
                graphHeight: 600,
                graphWidth: 320,
                labels: [
                    'Total',
                    'Today',
                ],
                names: [
                    'Total',
                    'Unique',
                    'Undefined IP'
                ],
                values: [
                    [ this.totalAllVisits, this.todayAllVisits ],
                    [ this.totalUniqueVisits, this.todayUniqueVisits ],
                    [ this.totalUndefinedIp, this.todayUndefinedIp ]
                ]
            }
        },
        mounted() {
            this.graphWidth = this.$refs.graph.clientWidth;
        }
    }
</script>

<style scoped>

</style>