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
        header('Location:$reg');
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
                    <a href="user_page.php?query=user_password" class="active"><i class="fa fa-lock" aria-hidden="true"></i>CHANGE PASSWORD</a>
                </li>
                <li>
                    <a href="user_page.php?query=user_data"><i class="fa fa-user" aria-hidden="true"></i>EDIT DATA</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <form id="update-password-form" method="POST" action="../php/update_password.php" accept-charset="UTF-8">

                     <div class="pass-change" id="ubah-password">
                          <div class="pass-change-wrapper">
                            <label for="">New Password</label>
                            <input required name="password" type="password" value=""><br>
                            <label for="">Confirm New Password</label>
                            <input required name="pass_confirm" type="password" value=""><br>
                            <div>
                                <span id="submit-failed" style="color:red;line-height:20px;font-size: smaller;font-style: italic;font-weight: bolder;"></span>
                            </div>
                            <input type="submit" value="Change Password" onclick="return submitnewpass();">
                          </div>
                     </div>
            </form>
        </div>
    </div>
</div>
<script>
    function submitnewpass(){     
        var dataS = $('update-password-form').serialize();
        $.ajax({
            type:'POST',
            url:'../php/update_password.php',
            data:dataS,
            success: function(html){                
                if(html=='ok')
                    alert('Ok. Your password has been reset.');
                    //window.location.replace('http://localhost/dry');
                else
                    $('#submit-failed').html(html);
            },
            error : function(request,error){
                alert(error);
            }
        });
        return false;
     }
</script>