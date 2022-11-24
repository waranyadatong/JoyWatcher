<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="js/Chart.js"></script>
    <script type="text/javascript">
        if ("WebSocket" in window) {

            var ws = new WebSocket("ws://localhost:8080/ws");

            ws.onopen = function() {
                ws.send("data");
            };

            ws.onmessage = function(evt) {
                var received_msg = JSON.parse(evt.data)
                alert(received_msg[0]);
                alert(received_msg[1]);
                lineChartData.labels = received_msg[0];
                lineChartData.datasets[0].data = received_msg[1];
                lineChartData.update();

            };


            ws.onclose = function() {
                // websocket is closed.
                console.log("Connection is closed...");
            };
        } else {
            // The browser doesn't support WebSocket
            console.log("WebSocket NOT supported by your Browser!");
        }
    </script>
</head>

<body>
    <div style="width:70%">
        <div>
            <canvas id="canvas" height="450" width="800"></canvas>
        </div>
    </div>


    <script>
        var lineChartData = {
            labels: [],
            datasets: [{
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: []
            }]
        }

        var options = {
            responsive: true,
            scaleShowGridLines: false,
            scaleLineColor: "rgba(0,0,0,.1)",
        }


        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, options);
    </script>

</body>

</html>