<?php
class LoginPageView
{
    public function content($error) {
        ?>
        <div class="login">
            <div>
                <h2>Admin Login</h2>
                <form action="/Project/Api/api.php" method="post">
                    <input type="text" name="admin_username" placeholder="Username" required><br>
                    <input type="password" name="admin_password" placeholder="Password" required><br>
                    <button type="submit" name="login">Login</button>
                </form>
                <?php
                    if($error==1){
                    ?>    
                        <div class="mt-2 alert alert-danger alert-dismissible  fade show text-center px-2" role="alert">
                            username or password is incorrect!
                        </div>
                        <?php
                    }?> 
            </div>
            
        </div>
        <?php
    }
    
    public function showLoginPage($error)
    {
        $this->content($error);
    }
}