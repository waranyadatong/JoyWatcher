<?php
  date_default_timezone_set('Asia/Bangkok');
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
   page_require_level(1);  
?>

<?php include_once('layouts/header.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<title>form date and time by devbanban.com</title>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <h2> Form Date & Time by devbanban.com </h2>
      <form action="http://devbanban.com/" method="POST"   name="add" class="form-horizontal" id="add">
        <div class="form-group">
          <div class="col-sm-2" align="right"> ว/ด/ป </div>
          <div class="col-sm-2" align="left">
            <input  name="dates " type="date" required class="form-control" id="dates" />
          </div>
          </div>
          <div class="form-group">
          <div class="col-sm-2" align="right"> เวลา </div>
          <div class="col-sm-2" align="left">
            <select name="times" id="times" required="required" class="form-control">
              <option value="08:00">08:00</option>
              <option value="20:00">20:00</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-2"> </div>
          <div class="col-sm-2">
            <button type="submit" class="btn btn-primary" id="btn" style="width: 100%"> เพิ่มข้อมูล </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<?php include_once('layouts/footer.php'); ?>