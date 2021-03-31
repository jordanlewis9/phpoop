  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
    <script src="js/scripts.js"></script>
    <script>
    var piechart = document.getElementById('piechart') || false;
    console.log(piechart);
    if (piechart) {
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session->count; ?>],
          ['Photos',      <?php echo $total_photos; ?>],
          ['User',  <?php echo $total_users; ?>],
          ['Comments', <?php echo $total_comments; ?>]
        ]);

        var options = {
          legend: 'none',
          pieSliceText: 'label',
          backgroundColor: 'transparent',
          slices: [{color: 'blue'}, {color: 'green'}, {color: 'orange'}, {color: 'red'}]
        };

        var chart = new google.visualization.PieChart(piechart);

        chart.draw(data, options);
      }
    }
      </script>
</body>

</html>
