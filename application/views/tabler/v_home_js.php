<script>
    // @formatter:off

    $(document).ready(function() {

        const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "Desember"];
        var nonrutin = 10
        var rutin = 20

        const d = new Date();
        let bulan = month[d.getMonth()];
        let year = d.getFullYear();

        $('#pie-bulan').text(bulan + ' ' + year)
        $('#pie a').append(' ' + year)

        $('#sta-bulan').text(bulan + ' ' + year)
        $('#sta a').append(' ' + year)

        $('#prio-bulan').text(bulan + ' ' + year)
        $('#prio a').append(' ' + year)

        $('#pie-' + bulan.toLowerCase()).addClass('active')
        $('#sta-' + bulan.toLowerCase()).addClass('active')
        $('#prio-' + bulan.toLowerCase()).addClass('active')

        /*
        $('#pie-januari').on('click', function(e) {
            e.preventDefault()
            $('#pie-bulan').text($(this).text())
            $('#pie a').removeClass('active')
            $(this).addClass('active')
            rutin = 20
            nonrutin = 25
            console.log(rutin, nonrutin)
            chart.updateSeries([35, 18])
        })

        $('#pie-februari').on('click', function(e) {
            e.preventDefault()
            $('#pie-bulan').text($(this).text())
            $('#pie a').removeClass('active')
            $(this).addClass('active')
            rutin = 35
            nonrutin = 58
            console.log(rutin, nonrutin)


            chart.updateSeries([35, 58])
        })
        */

        $('#pie a').on('click', function(e) {
            e.preventDefault()
            $('#pie a').removeClass('active')
            $(this).addClass('active')
            $('#pie-bulan').text($(this).text())
            //alert($(this).attr('s-bln'))

            $.ajax({
                url: "<?php echo base_url(); ?>dashboard/data/1/" + $(this).attr('s-bln'),
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'nok') {
                        chart.updateSeries([0, 0], true)

                    } else {
                        //rt = response.rutin
                        //nrt = response.nonrutin
                        //chart.resetSeries (true,true)
                        chart.updateSeries([Number(response.rutin), Number(response.nonrutin)], true)


                    }

                }
            });
        })

        $('#sta a').on('click', function(e) {
            e.preventDefault()
            $('#sta a').removeClass('active')
            $(this).addClass('active')
            $('#sta-bulan').text($(this).text())
            //alert($(this).attr('s-bln'))

            $.ajax({
                url: "<?php echo base_url(); ?>dashboard/data/2/" + $(this).attr('s-bln'),
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'nok') {
                        chart.updateSeries([0, 0], true)

                    } else {
                        //rt = response.rutin
                        //nrt = response.nonrutin
                        //chart.resetSeries (true,true)
                        //chart.updateSeries([Number(response.rutin), Number(response.nonrutin)], true)

                        chart_sta.updateSeries([{
                            name: "Jumlah",
                            data: [Number(response.belum),Number(response.progres),Number(response.pending),Number(response.tidak),Number(response.selesai),Number(response.approve)]
                        }])



                    }

                }
            });
        })

        $('#prio a').on('click', function(e) {
            e.preventDefault()
            $('#prio a').removeClass('active')
            $(this).addClass('active')
            $('#prio-bulan').text($(this).text())

            $.ajax({
                url: "<?php echo base_url(); ?>dashboard/data/3/" + $(this).attr('s-bln'),
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'nok') {
                        chart.updateSeries([0, 0], true)

                    } else {
                        //rt = response.rutin
                        //nrt = response.nonrutin
                        //chart.resetSeries (true,true)
                        //chart.updateSeries([Number(response.rutin), Number(response.nonrutin)], true)

                        chart_prio.updateSeries([{
                            name: "Jumlah",
                            data: [Number(response.rendah),Number(response.menengah),Number(response.tinggi),Number(response.urgent)]
                        }])



                    }

                }
            });
        })

        var options_pie2 = {
            series: [<?php echo $rutin ?>, <?php echo $nonrutin ?>],
            chart: {
                type: 'donut',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };


        var options_pie = {
            chart: {
                type: "donut",
                fontFamily: 'inherit',
                height: 300,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: true
                },
                toolbar: {
                    show: true,
                },
            },
            fill: {
                opacity: 1,
            },
            dataLabels: {
                enabled: true,
                formatter: function(value, {
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    return w.config.series[seriesIndex]
                }
            },
            series: [<?php echo $rutin ?>, <?php echo $nonrutin ?>],
            labels: ["Rutin", "Insidentil"],
            grid: {
                strokeDashArray: 4,
            },
            colors: ["#206bc4", "#7DCFB6"],
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 12,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                    vertical: 8
                },
            },
            tooltip: {
                fillSeriesColor: false
            },
            updated: function(chart) {

            }
        }

        var chart = new ApexCharts(document.querySelector("#chart-demo-pie"), options_pie);
        chart.render();


        var options_chart_sta = {
            series: [{
                name: "Jumlah",
                data: [<?php echo $belum; ?>, <?php echo $progres; ?>, <?php echo $pending; ?>, <?php echo $tidak; ?>, <?php echo $selesai; ?>, <?php echo $approve; ?>]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Belum Dikerjakan', 'On Progres', 'Pending', 'Tidak Dikerjakan', 'Selesai', 'Aprrove'],
            },
            yaxis: {
                title: {
                    text: 'Kerusakan'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Kerusakan"
                    }
                }
            }
        };

        var chart_sta = new ApexCharts(document.querySelector("#chart-sta"), options_chart_sta);
        chart_sta.render();

        var options_chart_prio = {
            series: [{
                name: "Jumlah",
                data: [<?php echo $rendah; ?>, <?php echo $menengah; ?>, <?php echo $tinggi; ?>, <?php echo $urgent; ?>]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Rendah', 'Menegah', 'Tinggi', 'Urgent'],
            },
            yaxis: {
                title: {
                    text: 'Kerusakan'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Kerusakan"
                    }
                }
            }
        };

        var chart_prio = new ApexCharts(document.querySelector("#chart-prio"), options_chart_prio);
        chart_prio.render();
    })


    // @formatter:on
</script>