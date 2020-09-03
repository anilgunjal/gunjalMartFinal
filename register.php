<?php include 'header.php';?>
<script src="assets/js/register.js"></script>
    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register">
                        <h2>Register</h2>
                        <form action="#" id="register" >
                            <p>   
                                <label>Name <span>*</span></label>
                                <input name = "name" id = "name" type="text">
                             </p>
                             <p>   
                                <label>Mobile No. <span>*</span></label>
                                <input name ="mobile" id ="mobile" type="text">
                             </p>
                             <p>   
                                <label>Passwords <span>*</span></label>
                                <input name ="password" id = "password" type="password">
                             </p>
                             <p>   
                                <label>Email address  <span></span></label>
                                <input name ="email" id = "email" type="text">
                             </p>
                            <div class="success alert alert-success" role="alert" style="display:none;"></div>
                            <div class="error alert alert-danger" role="alert" style="display:none;"></div>
                            <div class="login_submit">
                                <button id="regbtn" type="submit">Register<span style="display:none;" id="loading">&nbsp;<i class="fa fa-spinner fa-spin"></i></span></button>
                            </div>
                            
                        </form>
                    </div>    
                </div>
                <!--register area end-->
            </div>
        </div>    
    </div>
    <!-- customer login end -->

<?php include 'footer.php';?>