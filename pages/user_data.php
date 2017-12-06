<?php 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
    require_once('../php/db.php');
    require_once('../php/error.php');
    set_error_handler('handleError');
    include('../php/url.php');
    set_error_handler('handleError');
    if(!isset($_SESSION['login_user'])){
        header('Location: '.$reg);
    }
?>
<div class="user-right right">
    <div class="user-dashboard">
        <h1>
            <i class="fa fa-cog" aria-hidden="true"></i>
                Setting
        </h1>
        <div class="order-content">
            <ul class="tabs">
                <li>
                    <a href="user_page.php?query=user_password"><i class="fa fa-lock" aria-hidden="true"></i>CHANGE PASSWORD</a>
                </li>
                <li>
                    <a href="user_page?query=user_data" class="active"><i class="fa fa-user" aria-hidden="true"></i>EDIT DATA</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
                        <div id="ubah-data" class="ubah-data">
                            <form name="update-profile-form" id= "update-profile-form" method="POST" action="../php/update_profile.php">
                                <ul>
                                   <?php 
                                        include '../php/db.php';
                                        include '../php/url.php';
                                        include '../php/validate.php';
                                        require_once '../php/error.php';                            
                                        set_error_handler('handleError');
                                        $id = $_SESSION['id_user'];
                                        $sql="SELECT nama,alamat,no_telp FROM customer WHERE id_customer='$id'";
                                        mysqli_select_db($conn,"laundry");
                                        $result = mysqli_query($conn,$sql);
                                        if($result){
                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                            $count = mysqli_num_rows($result);
                                            if($count == 1) {
                                                $nama = $row['nama'];
                                                $alamat = $row['alamat'];
                                                $no_telp = $row['no_telp'];
                                                echo "<li>
                                                        <label>Name</label>
                                                        <input type='text' name='name' id='name' value='".$nama."'></li>";

                                            }

                                        }else
                                            echo mysqli_error($conn);
                                   ?>
                                	
                                    <li>
                                    	<label>Email</label>
                                        <label><?php echo $_SESSION['login_user'];?></label>
                                    </li>
                                    <?php 
                                        echo "<li>
                                                <label>Address</label>
                                                <input type='text' name='address' id='address' value='".$alamat."'></li>";
                                        echo "<li>
                                                <label>No Telpon</label>
                                                <input type='text' name='phone' id='phone' value='".$no_telp."'></li>  ";
                                    ?>
                                    
                                </ul>
                                <div class="submit-holder">
                                	<input type="submit" value="Change Profile">
                                </div>
                                
                            </form>
                        </div>
                    </div>
    </div>
</div>
<script>
    function submitnewprofile(){     
        var dataS = $('update-profile-form').serialize();
        $.ajax({
            type:'POST',
            url:'../php/update_profile.php',
            data:dataS,
            success: function(html){   
                alert(html);             
                if(html=='ok'){  
                    window.location.replace('http://localhost/dry/pages/user_page.php?query=user_data');
                }
            },
            error : function(request,error){
                //alert(error);
            }
        });
        return false;
     }
</script>