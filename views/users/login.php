<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form action="?controller=users&action=doLogin" method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <br/>
                     <?php
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        if(isset($_SESSION["error_login"]) && $_SESSION["error_login"] == true) {?>
                            <div class="alert alert-danger" role="alert">
                                <?php 
                                    echo 'Invalid User'; 
                                    unset($_SESSION["error_login"]);
                                ?>
                            </div>
                        <?php
                        }
                    ?>
                    <a href="?controller=users&action=newUser">Create Account</a> or <a href="?controller=pages&action=home">Back Home</a>
                    <br/>
                    <br/>
                    <button type="submit" class="btn btn-primary pull-right">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
