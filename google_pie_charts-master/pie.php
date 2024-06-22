<?php
  $con = mysqli_connect("localhost", "root", "", "end2end_llb");
  if(mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM custsales";
  $result = mysqli_query($con, $sql);

  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  mysqli_close($con);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Sales');

        <?php
          foreach ($data as $row) {
            echo "data.addRow(['April', " . $row['Aprr'] . "]);\n";
            echo "data.addRow(['May', " . $row['May'] . "]);\n";
            echo "data.addRow(['June', " . $row['Jun'] . "]);\n";
            echo "data.addRow(['July', " . $row['Jul'] . "]);\n";
            echo "data.addRow(['August', " . $row['Aug'] . "]);\n";
            echo "data.addRow(['September', " . $row['Sep'] . "]);\n";
            echo "data.addRow(['October', " . $row['Oct'] . "]);\n";
            echo "data.addRow(['November', " . $row['Novv'] . "]);\n";
            echo "data.addRow(['December', " . $row['Decc'] . "]);\n";
            echo "data.addRow(['January', " . $row['Jann'] . "]);\n";
            echo "data.addRow(['February', " . $row['Febb'] . "]);\n";
            echo "data.addRow(['March', " . $row['Marr'] . "]);\n";
          }
        ?>

        var options = {
          title: 'Monthly Sales',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>
