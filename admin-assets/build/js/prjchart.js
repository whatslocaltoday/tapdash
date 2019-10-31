$(document).ready(function() {
    var firstSelectDate;
    var lastSelectDate;
    var d = new Date();
    //for dropdown cookie
    var first_drp_sel_Item = getCookieJs('_dash_f_0047drp_itm');
    var sec_drp_sel_Item = getCookieJs('_dash_s_0048drp_itm');
    var thD_drp_sel_Item = getCookieJs('_dash_t_0049drp_itm');
    //get last select date from cookie
    // eraseCookieJS("_FdateF_G_0019dtpk_itm");
    // eraseCookieJS("_LdateL_G_0021dtpk_itm");
    var firstSelectDate = getCookieJs('_FdateF_G_0019dtpk_itm');
    var lastSelectDate = getCookieJs('_LdateL_G_0021dtpk_itm');
    // alert(lastSelectDate);
    if ((firstSelectDate) || (lastSelectDate)) {} else {
        firstSelectDate = d.getFullYear() + "-" + (d.getMonth()) + "-" + d.getDate();
        lastSelectDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    }
    getdataforchartfirstwhole(firstSelectDate, lastSelectDate);
    getdataforchartfirst_Google(firstSelectDate, lastSelectDate);
    getdataforchartfirst_Facebbok(firstSelectDate, lastSelectDate);
});
$(document).ready(function() {
    $("#reportrange").on("apply.daterangepicker", function(a, b) {
        var firstSelectDate;
        var lastSelectDate;
        firstSelectDate = b.startDate.format("YYYY-M-D");
        lastSelectDate = b.endDate.format("YYYY-M-D");
        //set cookies for selectd date
        setCookieJs('_FdateF_G_0019dtpk_itm', firstSelectDate);
        setCookieJs('_LdateL_G_0021dtpk_itm', lastSelectDate);
        var firstSelectDate_cok = getCookieJs('_FdateF_G_0019dtpk_itm');
        var lastSelectDate_Cok = getCookieJs('_LdateL_G_0021dtpk_itm');
        getdataforchartfirstwhole(firstSelectDate_cok, lastSelectDate_Cok);
        getdataforchartfirst_Google(firstSelectDate_cok, lastSelectDate_Cok);
        getdataforchartfirst_Facebbok(firstSelectDate_cok, lastSelectDate_Cok);
    })
});

function reload_cart() {
    var firstSelectDate_cok = getCookieJs('_FdateF_G_0019dtpk_itm');
    var lastSelectDate_Cok = getCookieJs('_LdateL_G_0021dtpk_itm');
    getdataforchartfirstwhole(firstSelectDate_cok, lastSelectDate_Cok);
    getdataforchartfirst_Google(firstSelectDate_cok, lastSelectDate_Cok);
    getdataforchartfirst_Facebbok(firstSelectDate_cok, lastSelectDate_Cok);
}
// for cookie part 
function setCookieJs(name, value) {
    var expires = "";
    var date = new Date();
    date.setDate(date.getDate() + 1);
    expires = "; expires=" + date.toUTCString();
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookieJs(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookieJS(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}

function firTdropDownfunction() {
    var xfrst = document.getElementById("firTdropDown").value;
    setCookieJs('_dash_f_0047drp_itm', xfrst);
    reload_cart();
    return true;
}

function seconDdropDownfunction() {
    var xscnd = document.getElementById("seconDdropDown").value;
    setCookieJs('_dash_s_0048drp_itm', xscnd);
    reload_cart();
    return true;
}

function thirDdropDownfunction() {
    var xthird = document.getElementById("thirDdropDown").value;
    setCookieJs('_dash_t_0049drp_itm', xthird);
    reload_cart();
    return true;
}



function firstHomegraphp_All(data) {
    var first_drp_sel_Item = getCookieJs('_dash_f_0047drp_itm');
    var sec_drp_sel_Item = getCookieJs('_dash_s_0048drp_itm');
    var thD_drp_sel_Item = getCookieJs('_dash_t_0049drp_itm');
    if (!first_drp_sel_Item) {
        first_drp_sel_Item = "View";
    }
    if (!sec_drp_sel_Item) {
        sec_drp_sel_Item = "Impression";
    }
    if (!thD_drp_sel_Item) {
        thD_drp_sel_Item = "Conversion";
    }
    var rerults = data;
    var plan_date = new Array();
    var traffic = new Array();
    var view = new Array();
    var lead = new Array();
    var cost = new Array();
    var buget = new Array();
    var f_graPh_Item = new Array();
    var s_graPh_Item = new Array();
    var t_graPh_Item = new Array();
    $.each(rerults, function(index, value) {
        if (first_drp_sel_Item) {
            if (first_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    f_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'View') {
                f_graPh_Item.push(value.view).toFixed(2);
            }
            if (first_drp_sel_Item == 'Impression') {
                f_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (first_drp_sel_Item == 'Conversion') {
                f_graPh_Item.push(value.lead).toFixed(2);
            }
            if (first_drp_sel_Item == 'Cost') {
                f_graPh_Item.push(value.cost).toFixed(2);
            }
            if (first_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    f_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    f_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    f_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        if (sec_drp_sel_Item) {
            if (sec_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    s_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'View') {
                s_graPh_Item.push(value.view).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Impression') {
                s_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Conversion') {
                s_graPh_Item.push(value.lead).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Cost') {
                s_graPh_Item.push(value.cost).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    s_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    s_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    s_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        if (thD_drp_sel_Item) {
            if (thD_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    t_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'View') {
                t_graPh_Item.push(value.view).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Impression') {
                t_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Conversion') {
                t_graPh_Item.push(value.lead).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Cost') {
                t_graPh_Item.push(value.cost).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    t_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    t_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    t_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        plan_date.push(value.plan_date);
        traffic.push(value.traffic);
        view.push(value.view);
        lead.push(value.lead);
        cost.push(value.cost);
        buget.push(value.buget);
    });
    // alert(f_graPh_Item);
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
                dataView: {
                    show: true,
                    readOnly: false
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        legend: {
            data: [first_drp_sel_Item, sec_drp_sel_Item, thD_drp_sel_Item]
        },
        xAxis: [{
            type: 'category',
            axisTick: {
                alignWithLabel: true
            },
            data: plan_date
        }],
        yAxis: [{
                type: 'value',
                name: first_drp_sel_Item,
                position: 'right',
                axisLine: {
                    lineStyle: {
                        color: colors[0]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            },
            {
                type: 'value',
                name: sec_drp_sel_Item,
                position: 'right',
                offset: 80,
                axisLine: {
                    lineStyle: {
                        color: colors[1]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            },
            {
                type: 'value',
                name: thD_drp_sel_Item,
                position: 'left',
                axisLine: {
                    lineStyle: {
                        color: colors[2]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            }
        ],
        series: [{
                name: first_drp_sel_Item,
                type: 'bar',
                data: f_graPh_Item
            },
            {
                name: sec_drp_sel_Item,
                type: 'bar',
                yAxisIndex: 1,
                data: s_graPh_Item
            },
            {
                name: thD_drp_sel_Item,
                type: 'line',
                yAxisIndex: 2,
                data: t_graPh_Item
            }
        ]
    };;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
}

function firstHomegraphp_All_Google(data) {
    var first_drp_sel_Item = getCookieJs('_dash_f_0047drp_itm');
    var sec_drp_sel_Item = getCookieJs('_dash_s_0048drp_itm');
    var thD_drp_sel_Item = getCookieJs('_dash_t_0049drp_itm');
    if (!first_drp_sel_Item) {
        first_drp_sel_Item = "View";
    }
    if (!sec_drp_sel_Item) {
        sec_drp_sel_Item = "Impression";
    }
    if (!thD_drp_sel_Item) {
        thD_drp_sel_Item = "Conversion";
    }
    var rerults = data;
    var plan_date = new Array();
    var traffic = new Array();
    var view = new Array();
    var lead = new Array();
    var cost = new Array();
    var buget = new Array();
    var f_graPh_Item = new Array();
    var s_graPh_Item = new Array();
    var t_graPh_Item = new Array();
    $.each(rerults, function(index, value) {
        if (first_drp_sel_Item) {
            if (first_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    f_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'View') {
                f_graPh_Item.push(value.view).toFixed(2);
            }
            if (first_drp_sel_Item == 'Impression') {
                f_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (first_drp_sel_Item == 'Conversion') {
                f_graPh_Item.push(value.lead).toFixed(2);
            }
            if (first_drp_sel_Item == 'Cost') {
                f_graPh_Item.push(value.cost).toFixed(2);
            }
            if (first_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    f_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    f_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    f_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        if (sec_drp_sel_Item) {
            if (sec_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    s_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'View') {
                s_graPh_Item.push(value.view).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Impression') {
                s_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Conversion') {
                s_graPh_Item.push(value.lead).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Cost') {
                s_graPh_Item.push(value.cost).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    s_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    s_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    s_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        if (thD_drp_sel_Item) {
            if (thD_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    t_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'View') {
                t_graPh_Item.push(value.view).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Impression') {
                t_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Conversion') {
                t_graPh_Item.push(value.lead).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Cost') {
                t_graPh_Item.push(value.cost).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    t_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    t_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    t_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        plan_date.push(value.plan_date);
        traffic.push(value.traffic);
        view.push(value.view);
        lead.push(value.lead);
        cost.push(value.cost);
        buget.push(value.buget);
    });
    var dom = document.getElementById("container_homegraphmain_Google");
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
                dataView: {
                    show: true,
                    readOnly: false
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        legend: {
            data: [first_drp_sel_Item, sec_drp_sel_Item, thD_drp_sel_Item]
        },
        xAxis: [{
            type: 'category',
            axisTick: {
                alignWithLabel: true
            },
            data: plan_date
        }],
        yAxis: [{
                type: 'value',
                name: first_drp_sel_Item,
                position: 'right',
                axisLine: {
                    lineStyle: {
                        color: colors[0]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            },
            {
                type: 'value',
                name: sec_drp_sel_Item,
                position: 'right',
                offset: 80,
                axisLine: {
                    lineStyle: {
                        color: colors[1]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            },
            {
                type: 'value',
                name: thD_drp_sel_Item,
                position: 'left',
                axisLine: {
                    lineStyle: {
                        color: colors[2]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            }
        ],
        series: [{
                name: first_drp_sel_Item,
                type: 'bar',
                data: f_graPh_Item
            },
            {
                name: sec_drp_sel_Item,
                type: 'bar',
                yAxisIndex: 1,
                data: s_graPh_Item
            },
            {
                name: thD_drp_sel_Item,
                type: 'line',
                yAxisIndex: 2,
                data: t_graPh_Item
            }
        ]
    };;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
}

function firstHomegraphp_All_Facebook(data) {
    var first_drp_sel_Item = getCookieJs('_dash_f_0047drp_itm');
    var sec_drp_sel_Item = getCookieJs('_dash_s_0048drp_itm');
    var thD_drp_sel_Item = getCookieJs('_dash_t_0049drp_itm');
    if (!first_drp_sel_Item) {
        first_drp_sel_Item = "View";
    }
    if (!sec_drp_sel_Item) {
        sec_drp_sel_Item = "Impression";
    }
    if (!thD_drp_sel_Item) {
        thD_drp_sel_Item = "Conversion";
    }
    var rerults = data;
    var plan_date = new Array();
    var traffic = new Array();
    var view = new Array();
    var lead = new Array();
    var cost = new Array();
    var buget = new Array();
    var f_graPh_Item = new Array();
    var s_graPh_Item = new Array();
    var t_graPh_Item = new Array();
    $.each(rerults, function(index, value) {
        if (first_drp_sel_Item) {
            if (first_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    f_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'View') {
                f_graPh_Item.push(value.view).toFixed(2);
            }
            if (first_drp_sel_Item == 'Impression') {
                f_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (first_drp_sel_Item == 'Conversion') {
                f_graPh_Item.push(value.lead).toFixed(2);
            }
            if (first_drp_sel_Item == 'Cost') {
                f_graPh_Item.push(value.cost).toFixed(2);
            }
            if (first_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    f_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    f_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (first_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    f_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        if (sec_drp_sel_Item) {
            if (sec_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    s_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'View') {
                s_graPh_Item.push(value.view).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Impression') {
                s_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Conversion') {
                s_graPh_Item.push(value.lead).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Cost') {
                s_graPh_Item.push(value.cost).toFixed(2);
            }
            if (sec_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    s_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    s_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (sec_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    s_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        if (thD_drp_sel_Item) {
            if (thD_drp_sel_Item == 'Cost/Conv.') {
                if (value.lead != '0') {
                    t_graPh_Item.push((value.cost / value.lead).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'View') {
                t_graPh_Item.push(value.view).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Impression') {
                t_graPh_Item.push(value.traffic).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Conversion') {
                t_graPh_Item.push(value.lead).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Cost') {
                t_graPh_Item.push(value.cost).toFixed(2);
            }
            if (thD_drp_sel_Item == 'Conv. Rate') {
                if (value.traffic != '0') {
                    t_graPh_Item.push((value.lead / value.traffic).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'CTR') {
                if (value.lead != '0') {
                    t_graPh_Item.push((value.traffic / value.lead).toFixed(2));
                }
            }
            if (thD_drp_sel_Item == 'Avg. CPC') {
                if (value.traffic != '0') {
                    t_graPh_Item.push((value.cost / value.traffic).toFixed(2));
                }
            }
        }
        plan_date.push(value.plan_date);
        traffic.push(value.traffic);
        view.push(value.view);
        lead.push(value.lead);
        cost.push(value.cost);
        buget.push(value.buget);
    });
    var dom = document.getElementById("container_homegraphmain_Facebook");
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
                dataView: {
                    show: true,
                    readOnly: false
                },
                restore: {
                    show: true
                },
                saveAsImage: {
                    show: true
                }
            }
        },
        legend: {
            data: [first_drp_sel_Item, sec_drp_sel_Item, thD_drp_sel_Item]
        },
        xAxis: [{
            type: 'category',
            axisTick: {
                alignWithLabel: true
            },
            data: plan_date
        }],
        yAxis: [{
                type: 'value',
                name: first_drp_sel_Item,
                position: 'right',
                axisLine: {
                    lineStyle: {
                        color: colors[0]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            },
            {
                type: 'value',
                name: sec_drp_sel_Item,
                position: 'right',
                offset: 80,
                axisLine: {
                    lineStyle: {
                        color: colors[1]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            },
            {
                type: 'value',
                name: thD_drp_sel_Item,
                position: 'left',
                axisLine: {
                    lineStyle: {
                        color: colors[2]
                    }
                },
                axisLabel: {
                    formatter: '{value}'
                }
            }
        ],
        series: [{
                name: first_drp_sel_Item,
                type: 'bar',
                data: f_graPh_Item
            },
            {
                name: sec_drp_sel_Item,
                type: 'bar',
                yAxisIndex: 1,
                data: s_graPh_Item
            },
            {
                name: thD_drp_sel_Item,
                type: 'line',
                yAxisIndex: 2,
                data: t_graPh_Item
            }
        ]
    };;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
}
//code for ajax request
function getdataforchartfirstwhole(firstSelectDate, lastSelectDate) {
    $.ajax({
        type: 'post',
        url: 'admin/Chart_data/homepage_getfirstgrapho',
        data: 'firstSelectDate=' + firstSelectDate + '&lastSelectDate=' + lastSelectDate, // Send dataFields var
        success: function(data) {
            if ($.trim(data) != 'false') {
                firstHomegraphp_All(data);
                return true;
            } else {
                return false;
            }
        }
    });
}

function getdataforchartfirst_Google(firstSelectDate, lastSelectDate) {
    $.ajax({
        type: 'post',
        url: 'admin/Chart_data/homepage_getfirstgrapho_Google',
        data: 'firstSelectDate=' + firstSelectDate + '&lastSelectDate=' + lastSelectDate, // Send dataFields var
        success: function(data) {
            if ($.trim(data) != 'false') {
                document.getElementById('second_div_graph').style.display = 'block';
                firstHomegraphp_All_Google(data);
                return true;
            } else {
                document.getElementById('third_div_graph').style.display = 'none';
                return false;
            }
        }
    });
}

function getdataforchartfirst_Facebbok(firstSelectDate, lastSelectDate) {
    $.ajax({
        type: 'post',
        url: 'admin/Chart_data/homepage_getfirstgrapho_Facebbok',
        data: 'firstSelectDate=' + firstSelectDate + '&lastSelectDate=' + lastSelectDate, // Send dataFields var
        success: function(data) {
            if ($.trim(data) != 'false') {
                document.getElementById('third_div_graph').style.display = 'block';
                firstHomegraphp_All_Facebook(data);
                return true;
            } else {
                document.getElementById('third_div_graph').style.display = 'none';
                return false;
            }
        }
    });
}