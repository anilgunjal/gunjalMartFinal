<?php include 'header.php';?>
<script src="assets/js/login.js"></script>
    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
               <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form">
                        <h2>Forget Password</h2>
                        <form id="login" action="#">
                            <p>   
                                <label>email <span>*</span></label>
                                <input name="email" id="email" type="text">
                             </p>
                             
                                <button id="loginbtn" type="submit">login<span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
                                
                            </div>

                        </form>
                     </div>    
                </div>
                <!--login area start-->
            </div>
        </div>    
    </div>
    <!-- customer login end -->

<?php include 'footer.php';?>