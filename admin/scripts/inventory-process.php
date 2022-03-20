<?php
require_once '../../core/init.php';

$general = new General();
$show = new Show();
$customer = new Customer();
$tool = new Tools();
$fileupload = new FileUpload();
$db = Database::getInstance();
// available tools
if (isset($_POST['action']) && $_POST['action'] == 'fetch_tool') {

	$tools = $tool->fetchInventory('farmTools', 'available', 1);
	if ($tools) {
			$output = '';

             $output .= '
      <table class="table table-striped table-condensed table-hover" id="showTools">
        <thead>
          <tr>
            <th>#</th>
            <th>Tool Image</th>
            <th>Tool Name</th>
            <th>Avaiable</th>
            <th>Tool Price</th>
            <th>Tool Type</th>
            <th>Secret key</th>
            <th>Action</th>


          </tr>
        </thead>
        <tbody>
      ';

       foreach ($tools as $to) {
       	$img = '<img src="../uploads/farmtools/'.$to->tool_img.'" class="img-fluid imgTool">';
       	if ($to->available == 1) {
       		$avb =  '<span class="text-success">Yes</span>';
       	}else{
       		$avb =  '<span class="text-danger">No</span>';
       	}
         $output .= '
          <tr>
         <td>'.$to->id.'</td>
         <td>'.$img.'</td>
         <td>'.$to->tool_name.'</td>
          <td>'.$avb.'</td>
         <td>'.$to->tool_price.'</td>
         <td>'.$to->tool_type.'</td>
         <td>'.$to->secret_key.'</td>
           <td>
           <a href="detail/member-detail/'.$to->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i>&nbsp;</a>

           </td>
            </tr>
            ';
             }

$output .= '
        </tbody>
      </table>';

echo  $output;
		}else{
      echo '<h3 class="text-center text-danger">No Data yet</h3>';
    }
	

}

// not available tools;/
if (isset($_POST['action']) && $_POST['action'] == 'fetch_toolnota') {

  $tools = $tool->fetchInventory('farmTools', 'available', 0);
  if ($tools) {
      $output = '';

             $output .= '
      <table class="table table-striped table-condensed table-hover" id="showToolsnot">
        <thead>
          <tr>
            <th>#</th>
            <th>Tool Image</th>
            <th>Tool Name</th>
            <th>Avaiable</th>
            <th>Tool Price</th>
            <th>Tool Type</th>
            <th>Secret key</th>
            <th>Action</th>


          </tr>
        </thead>
        <tbody>
      ';

       foreach ($tools as $to) {
        $img = '<img src="../uploads/farmtools/'.$to->tool_img.'" class="img-fluid imgTool">';
        if ($to->available == 1) {
          $avb =  '<span class="text-success">Yes</span>';
        }else{
          $avb =  '<span class="text-danger">No</span>';
        }
         $output .= '
          <tr>
         <td>'.$to->id.'</td>
         <td>'.$img.'</td>
         <td>'.$to->tool_name.'</td>
          <td>'.$avb.'</td>
         <td>'.$to->tool_price.'</td>
         <td>'.$to->tool_type.'</td>
         <td>'.$to->secret_key.'</td>
           <td>
           <a href="detail/member-detail/'.$to->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i>&nbsp;</a>

           </td>
            </tr>
            ';
             }

$output .= '
        </tbody>
      </table>';

echo  $output;
    }else{
      echo '<h3 class="text-center text-danger">No Data yet</h3>';
    }
  

}


// completed transactions
if (isset($_POST['action']) && $_POST['action'] == 'paidTransactions') {

  $transac = $tool->fetchInventory('transactions', 'deleted', 0);
  if ($transac) {
      $output = '';


             $output .= '
      <table class="table table-striped table-condensed table-hover" id="showPaidT">
        <thead>
          <tr>
            <th>#</th>
            <th>Item Image</th>
            <th>Item Name</th>
            <th>Duration</th>
            <th>Item Price</th>
            <th>Payment Status</th>
            <th>Action</th>


          </tr>
        </thead>
        <tbody>
      ';

       foreach ($transac as $paidunpaid) {
        $img = '<img src="../uploads/farmtools/'.$paidunpaid->item_img.'" class="img-fluid imgTool">';
        if ($paidunpaid->item_duration == 1) {
          $week =  '<span class="text-success">One Week</span>';
        }elseif($paidunpaid->item_duration == 2){
          $week =  '<span class="text-success">Two Weeks</span>';
        }
        elseif($paidunpaid->item_duration == 3){
          $week =  '<span class="text-success">Three Weeks</span>';
        }
        elseif($paidunpaid->item_duration == 4){
          $week =  '<span class="text-success">One Month</span>';
        }

        if ($paidunpaid->paid == 1) {
          $yes =  '<span class="text-success">Completed</span>';
        }elseif($paidunpaid->paid == 0){
          $yes =  '<span class="text-warning">Pending</span>';
        }
         $output .= '
          <tr>
         <td>'.$paidunpaid->id.'</td>
         <td>'.$img.'</td>
         <td>'.$paidunpaid->item_name.'</td>
          <td>'.$week.'</td>
         <td>'.$paidunpaid->item_price.'</td>
         <td>'.$yes.'</td>
           <td>
           <a href="detail/member-detail/'.$paidunpaid->id.'" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i>&nbsp;</a>

           </td>
            </tr>
            ';
             }

$output .= '
        </tbody>
      </table>';

echo  $output;
    }else{
      echo '<h3 class="text-center text-danger">No Data yet</h3>';
    }
  

}

// delivery status
if (isset($_POST['action']) && $_POST['action'] == 'fetch_delivery_statu') {

  $transac = $tool->fetchInventory('transactions', 'deleted', 0);
  if ($transac) {
      $output = '';


             $output .= '
      <table class="table table-striped table-condensed table-hover" id="showtoolsNotDe">
        <thead>
          <tr>
            <th>#</th>
            <th>Item Image</th>
            <th>Item Name</th>
            <th>Duration</th>
            <th>Item Price</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
            <th>Returned Status</th>
            <th>Action</th>


          </tr>
        </thead>
        <tbody>
      ';

       foreach ($transac as $paidunpaid) {
        $img = '<img src="../uploads/farmtools/'.$paidunpaid->item_img.'" class="img-fluid imgTool">';
        if ($paidunpaid->item_duration == 1) {
          $week =  '<span class="text-success">One Week</span>';
        }elseif($paidunpaid->item_duration == 2){
          $week =  '<span class="text-success">Two Weeks</span>';
        }
        elseif($paidunpaid->item_duration == 3){
          $week =  '<span class="text-success">Three Weeks</span>';
        }
        elseif($paidunpaid->item_duration == 4){
          $week =  '<span class="text-success">One Month</span>';
        }

        if ($paidunpaid->paid == 1) {
          $yes =  '<span class="text-success">Completed</span>';
        }elseif($paidunpaid->paid == 0){
          $yes =  '<span class="text-warning">Pending</span>';
        }

        if ($paidunpaid->delivered == 1) {
          $del =  '<span class="text-success">Delivered</span>';
        }elseif($paidunpaid->delivered == 0){
          $del =  '<span class="text-warning">Not Delivered</span>';
        }

        if ($paidunpaid->returned == 0 && $paidunpaid->delivered == 1) {
          $ret =  '<span class="text-warning">Not Returned</span>';
        }elseif($paidunpaid->delivered == 0 && $paidunpaid->returned == 0){
            $ret =  '<span class="text-danger">Nill</span>';

        }elseif($paidunpaid->returned == 1){
            $ret =  '<span class="text-success">Returned</span>';
          }

         $output .= '
          <tr>
         <td>'.$paidunpaid->id.'</td>
         <td>'.$img.'</td>
         <td>'.$paidunpaid->item_name.'</td>
          <td>'.$week.'</td>
         <td>'.$paidunpaid->item_price.'</td>
         <td>'.$yes.'</td>
         <td>'.$del.'</td>
         <td>'.$ret.'</td>
           <td>
           <a id="'.$paidunpaid->id.'" class="btn btn-sm btn-warning returned"><i class="fa fa-recycle fa-lg"></i>&nbsp;Returned</a>
            <a id="'.$paidunpaid->id.'" class="btn btn-sm btn-danger delivered"><i class="fa fa-play fa-lg"></i>&nbsp; Delivered</a>
           </td>
            </tr>
            ';
             }

$output .= '
        </tbody>
      </table>';

echo  $output;
    }else{
      echo '<h3 class="text-center text-danger">No Data yet</h3>';
    }
  

}

if (isset($_POST['d_id']) && !empty($_POST['d_id'])) {
    $did = $_POST['d_id'];
    $gb = $db->query("SELECT * FROM transactions WHERE id = '$did'");
    if ($gb->count()) {
        $row = $gb->first();
        if ($row->delivered == 1) {
          return true;
        }else{
          if ($row->paid == 0) {
            return false;
          }else{
             $db->query("UPDATE transactions SET delivered = 1 WHERE id = '$did' ");
             return true;
          }
         
        }
    }
}

if (isset($_POST['r_id']) && !empty($_POST['r_id'])) {
    $rid = $_POST['r_id'];
    $gb = $db->query("SELECT * FROM returned WHERE id = '$rid'");
    if ($gb->count()) {
        $row = $gb->first();
        if ($row->returned == 1) {
          return true;
        }else{
          $db->query("UPDATE transactions SET returned = 1 WHERE id = '$rid' ");
          return true;
        }
    }
}


if (isset($_FILES['tool_img']) && !empty($_FILES['tool_img'])) {

   $file = $_FILES['tool_img'];
    $filename = $file['name'];
    //  var_dump($_FILES);
    // die();

    if (empty($file['name'])) {
        echo $show->showMessage('danger', 'File cant be empty!', 'warning');
        return false;
    }
    if (!$fileupload->isImage($filename)) {
        echo $show->showMessage('danger', 'File is not a valid image!', 'warning');
        return false;

    }
    if ($fileupload->fileSize($filename)) {
        echo $show->showMessage('danger', 'File size is too large!', 'warning');
        return false;
    }

    $ds = DIRECTORY_SEPARATOR;
    $temp_file = $file['tmp_name'];
    $file_path = $fileupload->moveFile($temp_file, "uploads","farmtools", $filename)->path();
    $fileSize = $file['size'];

    $name = Input::get('tool_name');
    $price = Input::get('tool_price');
    $type = Input::get('tool_type');
    $key = generateKey8();

   $db->query("INSERT INTO farmTools (tool_name, tool_img, tool_price, tool_type, secret_key) VALUES ('$name','$file_path','$price', '$type', '$key') ");
    echo 'success';

}