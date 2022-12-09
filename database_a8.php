<?php
    date_default_timezone_set('Asia/Bangkok');
    if (isset($_POST['rev']) && $_POST['rev'] == 1) {
        $j = '{'
        . '"s":"' . date('Y-m-d H:i:s') . ' "'
        . '}' ; 
        echo $j;
        exit();
    }
?> 
<?php
    $page_title = 'Joy Watcher';
    require_once('includes/load.php');
    //page_require_level(1);  
?>
<?php include_once('layouts/header.php'); ?>

<head>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.10.3/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

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
        margin-left: 21px;
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
    #fromdate {
        width: 180px;
        margin-left: 7px;
        margin-right: 25px;
    }
    #todate {
        width: 180px;
        margin-left: 7px;
    }
    #tbl_exporttable_to_xls {
        margin-top: 30px;
    }
    /*#tbl_exporttable_to_xls th {
        background-color: #55A2C8;
    }*/
    #selectdate {
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
        <h3 class="panel-title" style="font-size: 18px;"><center>Database of MOT A-A8</h3>
    </div>
    <div class="panel-body">
        <form class="form-inline" method="GET" id="selectdate" action="#">
            <label for="From Date">From Date</label>   
            <input type="date" id="fromdate" name="sdate" class="form-control" value="<?php echo $sdate; ?>" required>
            <label for="To Date">To Date</label> 
            <input type="date" id="todate" name="edate" class="form-control" value="<?php echo $edate; ?>" required>
            <button class="button button1" ><span class="glyphicon glyphicon-search"></span> Filter</button> 
            <!--<button onclick="clearform()" class="button button2"><span class="glyphicon glyphicon-repeat"></span> Reset</button>-->
            <?php if (isset($_GET['sdate']) && isset($_GET['edate'])) { ?> 
            <button onclick="downloadXlsx()" class="button button3"><span class="glyphicon glyphicon-floppy-save"></span> Export to Excel</button>             
        </form>
       
        <table class="table table-bordered table-striped" id="tbl_exporttable_to_xls">
            <thead class="table-success">
                <tr>
                    <th class='text-center'>Date Time</th>
                    <th class='text-center'>Product Name</th>
                    <th class='text-center'>Count</th>
                    <th class='text-center'>Start Time</th>
                    <th class='text-center'>End Time</th>
                    <th class='text-center'>Use Time(Sec)</th>
                </tr>
            </thead>
            <tbody>
                <?php                               
                    //if(isset($_GET['sdate']) || isset($_GET['edate'])){     
                    $sdate = $_GET['sdate'];
                    $edate = $_GET['edate'];
                    $time = date('H:i:s',strtotime('08:00:00'));
                    $timeAdmin = date('H:i:s',strtotime('08:00:00')); 
                    $TimeAdmin = $sdate.' '.$timeAdmin; 
                    $sqlAdmin = $db->query("SELECT Date_Time,Product_Name,Count,start_time,end_time FROM a8 WHERE Date_Time BETWEEN '$sdate $time' AND '$edate $time'");
                    $usetime = 0;
                    $F1 = TRUE;
                    while($data=$sqlAdmin->fetch_array(MYSQLI_ASSOC)){
                        if ($F1){ 
                            $F1 = false;
                            $usetime = (strtotime($data['end_time']) - strtotime($TimeAdmin));                
                        }else{
                            $usetime = (strtotime($data['end_time']) - strtotime($data['start_time'])); 
                        }
                        echo "<tr >
                        <td><center>$data[Date_Time]</center></td> 
                        <td><center>$data[Product_Name]</td>
                        <td><center>$data[Count]</td>
                        <td><center>$data[start_time]</td>
                        <td><center>$data[end_time]</td>
                        <td><center>$usetime</td>           
                        </tr>";
                    }                    
                ?>
            </tbody>
        </table> 
        <?php } ?>
    </div>
</div>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "Database" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'binary' }) :
        XLSX.writeFile(wb, fn || ('Database_JoyWatcher.' + (type || 'xlsx')));
    }
</script>

<script>          
    function clearform() {
        document.getElementById("fromdate").value = "";
        document.getElementById("todate").value = "";
    }
</script>

<script>
    function downloadXlsx() {
        var elt = document.getElementById('tbl_exporttable_to_xls');
        //var elt2 = document.getElementById('tbl_exporttable_to_xls2');
        var ws = XLSX.utils.table_to_sheet(elt);
        //var ws2 = XLSX.utils.table_to_sheet(elt2);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Database_A8");
        //XLSX.utils.book_append_sheet(wb, ws2, "Sheet 2");
        var wbout = XLSX.write(wb, {
            bookType: 'xlsx',
            bookSST: true,
            type: 'binary'
        });
        saveAs(new Blob([s2ab(wbout)], {
            type: "application/octet-stream"
        }), 'Database_A8.xlsx');
    }
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
</script>

<script>
    $(function() {
        function realTime() {
            setTimeout(function(){
                $.ajax({    
                    method: "POST",   
                    data: { rev: 1 },
                    dataType: "json"   
                }).done(function( data ) {
                    $("#time").html(data.s); 
                    $("#time").addClass("realtime");
                });
                realTime(); 
            }, 1000);  
        }
        realTime();
    });
</script>
<?php include_once('layouts/footer.php'); ?>