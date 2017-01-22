<?php


require_once './config.php';
if (!isset($_SESSION["user_id"]) && $_SESSION["user_id"] == "") {
  // user already logged in the site
  header("location:" . SITE_URL);
}
include './header.php';

$success = FALSE;
$error = FALSE;

 if(isset($_POST["mode"]) && $_POST["mode"] == "type2") {
  $msg = $_POST["msg"];
  $param = array(
    'message' => $msg,
    'link' => "http://www.phphive.info",
   );
  
  try {
    $posted = $facebook->api('/me/feed/', 'post', $param);
    if (strlen($posted["id"]) > 0 ) $success = TRUE;
  } catch  (FacebookApiException $e) {
    $errMsg = $e->getMessage();
    $error = TRUE;
  }
  
} 

?>
<div class="container mainbody">
    <?php if ($error) { ?>
    <div class="alert alert-dismissable alert-warning">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <h4>Oops Some Error Occured !</h4>
      <p><?php echo $errMsg; ?></p>
    </div>
    <?php } else if ($success) { ?>
  <div class="alert alert-dismissable alert-success">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <h4>Success</h4>
      <p>It has been successfully posted to your Timeline.</p>
    </div>
    <?php } ?>
  
  
    <div class="clearfix"></div>
    
    
    <div class="row pull-left">
        <a class="btn btn-primary" href="<?php echo  $logoutURL; ?> "><span class="glyphicon glyphicon-heart"></span> Hi <?php echo $user_profile["name"]; ?></a>
    </div>
    <div class="row pull-right">
        <a class="btn btn-danger" href="<?php echo  $logoutURL; ?> "><span class="glyphicon glyphicon-log-out"></span> Logout</a>
    </div>
    <div class="clearfix"></div>

    
    

      <div style="height: 10px; clear: both"></div>
      <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Post Message, Link  to your Facebook Timeline<i class="fa fa-info-circle" aria-hidden="true"  data-toggle="tooltip" title="Please write user id which canbe seen followed by @ symbol below his name on page or the after the last  '/' URL " id="blah"></i>:</label>
       </h3>
          </div>
          <div class="panel-body">
            <form class="bs-example form-horizontal" method="post" action="home.php">
              <input type="hidden" name="mode" value="type2" />
              <div class="table-responsive">
                <table class="table table-bordered table-hover ">
                  <tr>
                    <td><input type="text" name="msg" placeholder="Your Message" required class="form-control" autocomplete="off" ></td> 
                  </tr>
                  <tr>
                    <td><strong>Link:</strong></td> 
                    <td>http://ec2-52-66-141-30.ap-south-1.compute.amazonaws.com/post/response.php</td>
                  </tr>
                   
                </table>
              </div>

              <div class="clearfix"></div>
               <div class="form-group">
                    <div class="col-lg-12">
                      <button class="btn btn-primary" type="submit">Post and Check your Wall</button> 
                    </div>
                  </div>
              
             
            </form>
          </div>
        </div>
           
              
             
            </form>
          </div>
        </div>
      

    </div>
</div>
<?php
include './footer.php';
?>