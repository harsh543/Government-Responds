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
 $app_access_token = $app_id . '|' . $app_secret;

$response = $facebook->api( '/'.$user_id.'/notifications', 'POST', array(

                'template' => $_POST['msg'],

                'href' => 'http://ec2-52-66-141-30.ap-south-1.compute.amazonaws.com/post/fromgovt.php',

                'access_token' => $access_token
            ) );      
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
            <h3 class="panel-title">How would you/have you responded to this issue? <i class="fa fa-info-circle" aria-hidden="true"  data-toggle="tooltip" title="Please use only keywords which you incorporate in your speeches or posts  " id="blah"></i>:</label>
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
                                 
                </table>
              </div>

              <div class="clearfix"></div>
               <div class="form-group">
                    <div class="col-lg-12">
                      <button class="btn btn-primary" type="submit">Notify Citizen</button> 
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