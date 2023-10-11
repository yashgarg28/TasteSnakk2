<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    $users = $result->fetch_assoc();
    
    if ($users) {
        
        if (password_verify($_POST["password"], $users["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $users["id"];
            
            header("Location: ../php-signup-login/1.html");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TasteSnakk</title>
    <link rel="stylesheet" href="login.css" />

    
    <!--Navbar-->
    <!-- Navigation -->
   
    <!--Navbar ends-->

    <!--Main content of login page-->
    <!-- Section: Design Block -->
   
              <form method="post" class="login-form"> 
              <h1 class="login-text">Login</h1><br>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>

    <div class="signup__field">
         <label for="email">Email</label>
            <input type="email" id="email" name="email">
      </div>

                  <!-- Password input -->
                  <div class="signup__field">
        <label for="password">Password</label>
            <input type="password" id="password" name="password">
      </div>
                    
                  </div>

                  <!-- Submit button -->
                  <div class="login-signup">
                  <button>Log in</button>
                  <br><br>
                  <p class="signup-login">New User?&nbsp;<a href="signup2.html">Sign Up</a></p>
    </div>
    </form>
                    
                  

               
                 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
    <!--Main content ends-->
  </body>
  
</html>
