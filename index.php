 


<html>
<head>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/3.3.7-js-bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
 <link rel="stylesheet" href="css/1.12.1-jquery-ui.css">
    
    <script type="text/javascript" src="js/1.12.1-jquery-ui.js"></script>
    <script type="text/javascript" src="js/palt-functions.js"></script>
<style>
body{
background-image: url("css/it-pic.jpg");
}
</style>
<script>
$(document).ready(function(){
var successUpdate = $( "#dialog-logout" ).dialog({
autoOpen: false
    });
});
function showLogoutMessage() {
 var logout =$( "#dialog-logout" ).dialog({
      autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
	  window.location.href="http://www.google.com";
        }
      }
    });
logout.dialog("open");

}
</script>

<style>



#menu {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  width: 100px;
  height: 100px;
}
.menu_simple ul {
	position: fixed;
    margin: 0; 
    padding-top: 300px;
    width:155px;
    height:100%;
    list-style-type: none;
    background-color: #005555;
}

.menu_simple ul li a {
    text-decoration: none;
    color: white; 
    padding: 10.5px 11px;
    background-color: #005555;
    display:block;
}
 
.menu_simple ul li a:visited {
    color: white;
}
 
.menu_simple ul li a:hover, .menu_simple ul li .current {
    color: white;
    background-color: #5FD367;
}


</style>
</head>

<body>

<div class="regular">
<div class="menu_simple">

<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="palt_input.php">Generate PALT</a></li>
    <li><a href="palt_info.php">Query PALT Records</a></li>
    <li><a href="modify_milestone.php">Modify Milestone Templates</a></li>
    <li><a onclick="showLogoutMessage();" >Logout</a></li>
</ul>

<div id="dialog-logout" title="CFO-IOC">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    You should close this window to securely end your session.
  </p>
</div>
</div>
</div>

</body>
</html>



