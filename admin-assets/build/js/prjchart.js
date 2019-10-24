$(document).ready(function()    {
    $("#reportrange").on("apply.daterangepicker",function(a,b){
        var firstSelectDate;
        var lastSelectDate;
        firstSelectDate=b.startDate.format("YYYY-M-D");
        lastSelectDate=b.endDate.format("YYYY-M-D");

        getdataforchartfirstwhole(firstSelectDate,lastSelectDate);
    })
    });


    function getdataforchartfirstwhole(firstSelectDate,lastSelectDate)
    {
           // Account_model->fetch_total_view_under_useraccount();
			$.ajax({
				type: 'post',
				url: 'admin/Chart_data/homepage_getfirstgrapho',
				data: 'firstSelectDate='+firstSelectDate+'&lastSelectDate='+lastSelectDate, // Send dataFields var
					success:function(data) {
                        
                        var dom = document.getElementById("container_homegraphmain");
                var myChart = echarts.init(dom);
                var app = {};
                option = null;
                app.title = 'Home graph';

                var colors = ['#5793f3', '#d14a61', '#675bba'];

                option = {
                    color: colors,

                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross'
                        }
                    },
                    grid: {
                        right: '20%'
                    },
                    toolbox: {
                        feature: {
                            dataView: {show: true, readOnly: false},
                            restore: {show: true},
                            saveAsImage: {show: true}
                        }
                    },
                    legend: {
                        data:['View','Impression','Click']
                    },
                    xAxis: [
                        {
                            type: 'category',
                            axisTick: {
                                alignWithLabel: true
                            },
                            data: ['1','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            name: 'View',
                            min: 0,
                            max: 250,
                            position: 'right',
                            axisLine: {
                                lineStyle: {
                                    color: colors[0]
                                }
                            },
                            axisLabel: {
                                formatter: '{value} ml'
                            }
                        },
                        {
                            type: 'value',
                            name: 'Impression',
                            min: 0,
                            max: 250,
                            position: 'right',
                            offset: 80,
                            axisLine: {
                                lineStyle: {
                                    color: colors[1]
                                }
                            },
                            axisLabel: {
                                formatter: '{value} ml'
                            }
                        },
                        {
                            type: 'value',
                            name: 'Click',
                            min: 0,
                            max: 25,
                            position: 'left',
                            axisLine: {
                                lineStyle: {
                                    color: colors[2]
                                }
                            },
                            axisLabel: {
                                formatter: '{value} °C'
                            }
                        }
                    ],
                    series: [
                        {
                            name:'View',
                            type:'bar',
                            data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
                        },
                        {
                            name:'Impression',
                            type:'bar',
                            yAxisIndex: 1,
                            data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
                        },
                        {
                            name:'Click',
                            type:'line',
                            yAxisIndex: 2,
                            data:[2.0, 2.2, 3.3, 4.5, 6.3, 10.2, 20.3, 23.4, 23.0, 16.5, 12.0, 6.2]
                        }
                    ]
                };
                ;
                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }		
							return true;
						}
				});
		
    }