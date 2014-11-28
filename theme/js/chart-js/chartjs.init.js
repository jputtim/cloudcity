/**
 * Created by westilian on 1/19/14.
 */

(function(){
    var t;
    function size(animate){
        if (animate == undefined){
            animate = false;
        }
        clearTimeout(t);
        t = setTimeout(function(){
            $("canvas").each(function(i,el){
                $(el).attr({
                    "width":$(el).parent().width(),
                    "height":$(el).parent().outerHeight()
                });
            });
            redraw(animate);
            var m = 0;
            $(".chartJS").height("");
            $(".chartJS").each(function(i,el){ m = Math.max(m,$(el).height()); });
            $(".chartJS").height(m);
        }, 30);
    }
    $(window).on('resize', function(){ size(false); });


    function redraw(animation){
        var options = {};
        if (!animation){
            options.animation = false;
        } else {
            options.animation = true;
        }


        var barChartData = {
            labels : ["Serv. Terceirizado PJ","Folha Pagamento","Material Consumo","Serv. Terceirizado PF","Material Permanente","DEA"],
            datasets : [
                {
                    fillColor : "#D9534F",
                    strokeColor : "#D9534F",
                    data : [65,59,90,81,56,55]
                },
                {
                    fillColor : "#6dc5a3",
                    strokeColor : "#6dc5a3",
                    data : [28,48,40,19,96,27]
                }
            ]

        }
        var optionsBar = {

            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.05)",
            scaleGridLineWidth : 1,
            barShowStroke : true,
            barStrokeWidth : 2,
            barValueSpacing : 20,
            barDatasetSpacing : 1,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

        }

        var myLine = new Chart(document.getElementById("bar-chart-js").getContext("2d")).Bar(barChartData, optionsBar);


        var Linedata = {
            labels : ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez","13º"],
            datasets : [
                {
                    label: "My First dataset",
                    fillColor: "rgba(217,83,79,0.2)",
                    strokeColor: "rgba(217,83,79,1)",
                    pointColor: "rgba(217,83,79,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(217,83,79,1)",
                    data: [65, 59, 80, 81, 56, 55, 40, 38, 26, 35, 60, 67, 84]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(101,206,167,0.2)",
                    strokeColor: "rgba(101,206,167,1)",
                    pointColor: "rgba(101,206,167,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(101,206,167,1)",
                    data: [28, 48, 40, 19, 52, 27, 38]
                }

            ]
        }
        var myLineChart = new Chart(document.getElementById("folha-chart-js").getContext("2d")).Line(Linedata);
        
        var pieData = [
            {
                value: 25,
                color:"#D9534F",
                label: "Executado"
            },
            {
                value : 100,
                color : "#6dc5a3",
                label: "Orçado"
            }

        ];

        var myPie = new Chart(document.getElementById("pie-chart-js").getContext("2d")).Pie(pieData);
        


        var donutData = [
            {
                value: 30,
                color:"#2a323f"
            },
            {
                value : 50,
                color : "#5f728f"
            },
            {
                value : 100,
                color : "#6dc5a3"
            },
            {
                value : 40,
                color : "#95D7BB"
            },
            {
                value : 120,
                color : "#b8d3f5"
            }

        ]
        var myDonut = new Chart(document.getElementById("donut-chart-js").getContext("2d")).Doughnut(donutData);
    }




    size(true);

}());
