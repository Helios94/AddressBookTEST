<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sign Up</h5>
                <form action="?controller=users&action=signup" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="confirm-password">Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                    </div>
                    <br/>
                     <?php
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        if(isset($_SESSION["signup_login"]) && $_SESSION["signup_login"] != '') {?>
                            <div class="alert alert-danger" role="alert">
                                <?php 
                                    echo $_SESSION["signup_login"];
                                    unset($_SESSION["signup_login"]);
                                ?>
                            </div>
                        <?php
                        }
                    ?>
                    <a href="?controller=users&action=login">Login</a> or <a href="?controller=pages&action=home">Back Home</a>
                    <br/>
                    <br/>
                    <button type="submit" class="btn btn-primary pull-right">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>
