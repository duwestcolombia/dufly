                $(function () {

                    $('#chart-rep').highcharts({
                        chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Gastos mensuales en tiquetes y hoteles'
                            },
                            subtitle: {
                                //text: 'Source: WorldClimate.com'
                            },
                            xAxis: {
                                categories: [
                                    'Jan',
                                    'Feb',
                                    'Mar',
                                    'Apr',
                                    'May',
                                    'Jun',
                                    'Jul',
                                    'Aug',
                                    'Sep',
                                    'Oct',
                                    'Nov',
                                    'Dec'
                                ],
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Pesos ($)'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>$ {point.y:.1f} </b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: [{
                                name: 'Tiquetes',
                                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

                            },{
                                name: 'Hoteles',
                                data: [0, 71.5, 0, 129.2, 50.0, 176.0, 175.6, 0, 316.4, 194.1, 95.6, 54.4]

                            }]
                        });
                    });