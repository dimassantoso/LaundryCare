<script>
        function makeOrder(){
            var dataString = $('#orderForm').serialize();
            $.ajax({
                type:'POST',
                url:'../php/make_order.php',
                data:dataString,
                success: function(html){                    
                    if(html=='ok')
                        window.location.replace('http://localhost/dry/pages/user_page.php?query=myorder');
                    //  $('modalMakeOrder').modal('fade');
                    else
                    alert(html);
                    //  $('#error_msg').html(html);
                },
                error : function(request,error){
                    alert(error);
                }
            });
            return false;
        }
    </script>
<div class="user-right right">
    <div class="user-dashboard">
        <h1>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                My Order
            <a href="#modalMakeOrder" data-toggle='modal'><i class="fa fa-plus" aria-hidden="true"></i></a>
        </h1>
        <div class="orders">
            <div class = "table-responsive">
                   <table class = "table table-striped table-hover">
                      
                     <!--  <caption>Order List</caption> -->
                      
                      <thead>
                         <tr>
                            <th>No</th>
                            <th>Invoice Code</th>
                            <th>Service Type</th>
                            <th>Order Date</th>
                            <th>Finish Date</th>
                            <th>Weight (Kg)</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                         </tr>
                      </thead>
                      
                      <tbody>
                        <?php 
                            include '../php/db.php';
                            include '../php/url.php';
                            include '../php/validate.php';
                            require_once '../php/error.php';                            
                            set_error_handler('handleError');
                            $id = $_SESSION['id_user'];
                            $sql="SELECT * FROM list_order WHERE id_user='$id' ORDER BY tgl_order DESC";
                            mysqli_select_db($conn,"laundry");
                            $result = mysqli_query($conn,$sql);
                            $i=1;
                            if(mysqli_num_rows($result)>0){                             
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $service="Laundry";                                 
                                    if($row['id_layanan']==2)
                                        $service="Dry Cleaning";
                                    $finish_date = $row['tgl_selesai'];
                                    $weight = "Not set yet";
                                    $total = "Not set yet";
                                    if($row['status']!="Menunggu"){
                                        
                                        $weight = $row['berat'];
                                        $total = $row['bayar'];
                                    }
                                    
                                    echo "<tr><td>".$i."</td><td>".$row['no_nota']."</td><td>".$service."</td><td>".$row['tgl_order']."</td><td>".$finish_date."</td><td>".$weight."</td><td>".$total."</td><td>".$row['status']."</td></tr>";
                                    $i++;
                                }
                                mysqli_close($conn);
                            }
                            else
                                echo "<h3>You have not made any order yet</h3>";
                        ?>
                       
                      </tbody>
                      
                   </table>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalMakeOrder" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">
                    Make Order
                </h3>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="main-login main-center">
            <form class="form-horizontal" name="orderForm" id="orderForm" method="post">
                        
                        <div class="form-group">
                            <label for="address" class="cols-sm-2 control-label">Your Address</label>
                            <div class="cols-sm-10">
                            <?php 
                                if(isset($_COOKIE['user_address']))
                                    echo "<input type='text' class='form-control' name='address' id='address' value='".$_COOKIE['user_address']."' required/>";
                                else
                                    echo"<input type='text' class='form-control' name='address' id='address'  placeholder='Enter your Address' required/>";
                            ?>
                                                                
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="service" class="cols-sm-2 control-label">Service Option</label>
                            <div class="cols-sm-10">
                                <label class="radio-inline"><input type="radio" value="1" id="service" name="service">Laudry Cleaning</label>
                                <label class="radio-inline"><input type="radio" value="2" id="service" name="service">Dry Cleaning</label>
                            </div>
                            <span id="error_msg" style="color:red;float:left;font-size: smaller;font-style: italic;font-weight: bolder;"></span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-8 col-sm-4">
                                <input type="submit" name="order" class="form-control" value="Make Order" onclick="return makeOrder();" />
                            </div>
                        </div>
                            </form>
                </div>
                
            </div>
            <!-- Modal Footer -->
            <!-- <div class="modal-footer">
                <div id="note"></div>
            </div> -->
        </div>
    </div>
</div>

