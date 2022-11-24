<?php
    date_default_timezone_set('Asia/Bangkok');
    if (isset($_POST['rev']) && $_POST['rev'] == 1) {
        $j2 = '{'
        . '"s2":"' . date('Y-m-d H:i:s') . ' "'
        . '}' ; 
        echo $j2;
        exit();
    }
?> 
<?php
    $page_title = 'Joy Watcher';
    require_once('includes/load.php');
    page_require_level(1);  
?>
<?php include_once('layouts/header.php'); ?>
    <style>
        .button {
            color: #FFFFFF; 
            padding: 8px; 
            border: none;
            font-size: 14px;
            border-radius: 4px;
        }
        .button1 {
            background-color: #004080; 
            border-color: #004080; 
            margin-left: 16px;
        }
        .button2 {
            background-color: #FF9905;
            border-color: #FF9905;
            margin-left: 12px;
        }
        .button3 {
            background-color: #1D8348; 
            border-color: #1D8348; 
            margin-left: 12px;
        }
        #runprogram {
          margin-left: 10px;
        }
        #fromrun {
            margin-top: 10px;
        }
    .panel-actions {
      margin-top: 0;
      margin-bottom: 0;
   }
   .panel-title {
      display: inline-block;
      width: 100%;
      font-size: 18px;
   }
   .panel-custom-horrible-purple {
      border-color: #03308b; /* #4302E1 #03308b */
   }
   .panel-custom-horrible-purple > .panel-heading {
      color: #FFFFFF;
      background: #03308b; /* #4302E1 #03308b */
      border-color: #03308b; /* #ddd #4302E1 #03308b*/
      text-align: center;
   }
    </style>
    <div class="container"></div>
    <div class="panel panel-custom-horrible-purple">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size: 18px"><center>Search Program</h3>
        </div>

        <div class="panel-body">
            <form class="form-inline" id="fromrun" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                <label>Product Name</label>   

                <input type="text" id="runprogram" name="search" required class="form-control" placeholder="Product Name">

                <button type="submit" class="button button1"><span class="glyphicon glyphicon-search"></span> Search</button>

                <button href="Runprogram.php" class="button button2"><span class="glyphicon glyphicon-repeat"></span> Clear</button>
                
                <!--<a href="Runprogram.php" class="btn btn-warning">Clear</a>-->   
            </form>
            <br/>
            <?php
                isset( $_POST['search'] ) ? $search = $_POST['search'] : $search = "";
                if( !empty( $search ) ) {
            ?>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th class='text-center'>No.</th>
                        <th class='text-center'>Program</th>
                        <th class='text-center'>Pcs/Sht</th>
                        <th class='text-center'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php       
                        $c = mysqli_connect( "localhost", "root", "", "database_pi" );
                        mysqli_query( $c, "SET NAMES UTF8" );
                        $sql = " SELECT * FROM program WHERE ( Program_Name LIKE '%".$search."%' ) ";
                        $q = mysqli_query( $c, $sql );
                        $no = 1;  
                        while($data= $q->fetch_array(MYSQLI_ASSOC)){
                            echo "<tr>
                            <td><center>".$no."</center></td> 
                            <td><center>".$data['Program_Name']."</td> 
                            <td><center>".$data['pcs']."</td>   
                            <td><center><a class='button button1'  href='Run.php?Program=".$data['Program_Name']."'>Start Program</a></td> 
                            </tr>";            
                            $no++;
                        }
                    }
                    ?>
                </tbody>
            </table> 
        </div>
    </div>

<!--<script>
var refreshId = setInterval(function()
{
    $('#responsecontainer').load('data.php');
}, 1000);
</script>-->
<script>
$(function() {
   function realTime() {
      setTimeout(function(){
         $.ajax({    
            method: "POST",   
            data: { rev: 1 },
            dataType: "json"   
         }).done(function( data ) {
            $("#time").html(data.s2); 
            $("#time").addClass("realtime");
         });
      realTime(); 
      }, 1000);  
   }
   realTime();
});
</script>

<?php include_once('layouts/footer.php'); ?>