<?php include ("header.php");?>

    <!-- LOG IN FORM -->
    <form method="POST" action="process.php">
        <div class="modal pt-5" id="modalLoginForm" style = "display:block" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">SIGN IN</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="defaultForm-username"> Username</label>
                            <input type="text" id="defaultForm-username" name="username" class="form-control validate" required>
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="defaultForm-pass"> Password</label>
                            <input type="password" id="defaultForm-pass" name="password" class="form-control validate" required>
                        </div>
                    </div>
                    <div class="modal-button d-flex justify-content-center">
                        <button class="btn btn-default" type="submit" name="Login" id="login-btn">Login</button>
                    </div>
                    <p>Forgot Password? </p>
    </form>
    <div class="modal-footer d-flex justify-content-center">
        <p>Not Registered?</p>

        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalRegisterForm">Register</button>
    </div>
    </div>
    </div>
    </div>

    <!----REGISTRATION FORM-->
    <form method="POST" action="process.php">
        <div class="modal fade pt-5" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">SIGN UP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-name" required> Username</label>
                            <input type="text" id="orangeForm-name" name="username" class="form-control validate">
                        </div>
                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-email" required> E-mail</label>
                            <input type="email" id="orangeForm-email" name="email" class="form-control validate">
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-pass" required> Password</label>
                            <input type="password" id="orangeForm-pass" name="password" class="form-control validate">
                        </div>

                        <div class="md-form mb-4">
                            <i class="fas fa-lock prefix grey-text"></i>
                            <label data-error="wrong" data-success="right" for="orangeForm-pass" required> Confirm
                                Password</label>
                            <input type="password" id="orangeForm-pass" name="cpassword" class="form-control validate">
                        </div>
                    </div>
                    <div class="modal-button d-flex justify-content-center">
                        <button class="btn btn-deep-orange" name="Register" type="submit">Sign up</button>
                    </div>
    </form>
    <div class="modal-footer d-flex justify-content-center">
        <p>Already Registered?</p>
        <button class="btn btn-deep-orange" data-toggle="modal" class="close" data-dismiss="modal">Log In</button>
    </div>
    </div>
    </div>
    </div>
    <?php include("footer.php");