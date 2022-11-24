   <?php
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
   page_require_level(1);  
?> 
<?php include_once('layouts/header.php');  ?> 
      <script src="http://code.jquery.com/jquery-latest.js"></script>
      <script>
  
function getDataFromDb()
{
  $.ajax({ 
        url: "getData.php" ,
        type: "POST",
        data: ''
      })
      .success(function(result) { 
        var obj = jQuery.parseJSON(result);
          if(obj != '')
          {
              //$("#myTable tbody tr:not(:first-child)").remove();
              $("#myBody").empty();
              $.each(obj, function(key, val) {
                  var tr = "<tr>";
                  tr = tr + "<td>" + val["Date_Time"] + "</td>";
                  tr = tr + "<td>" + val["Product_Name"] + "</td>";
                  tr = tr + "<td>" + val["Count"] + "</td>";
                  tr = tr + "<td>" + val["Takt_time"] + "</td>";
                  tr = tr + "</tr>";
                  $('#myTable > tbody:last').append(tr);
              });
          }

      });

}

setInterval(getDataFromDb, 10000);   // 1000 = 1 second
</script>          

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><center>Database</h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-striped"id="myTable">
        <thead>
          <tr >
            <th class='text-center'>Date_Time</th>
            <th class='text-center'>Product_Name</th>
            <th class='text-center'>Count</th>
            <th class='text-center'>Takt_time</th>
          </tr>
        </thead>
        <tbody id="myBody"></tbody>
      </table>   
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>