<?php
// Header
$pageTitle = "Login";
require_once "layouts/header.php";
// Middleware
require_once("app/middleware/guest.php");

require_once "app/models/User.php";
// Login Process
if (isset($_POST['login'])) {
    $errors = [];
    if (!$_POST['email'] || !$_POST['password']) {
        $errors['fields'] = "Please Enter Email And Password";
    }
    if (empty($errors)) {
        // check user exists in database
        $user = new User;
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $exists = $user->selectData();
        if (!$exists) {
            $errors['credentials'] = "Credentials not correct";
        } else {
            // password and email correct
            $user = $exists->fetch_object();
            // save user in session
            $_SESSION['user'] = $user;
            header("Location:index.php");
        }
    }
}
?>


<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-white">
                    <div class="card-body p-5">
                        <form class="mb-3 mt-md-4" action="login.php" method="POST">
                        <h2 class="fw-bold text-success text-uppercase text-center mb-4 fst-italic">Daily Notes</h2>

                            <?php
                            if (isset($errors)) { ?>
                                <p class="alert alert-danger text-center">
                                <?php
                                foreach ($errors as $error) {
                                    echo $error;
                                }
                            }
                                ?>
                                <div class="my-3">
                                    <label for="email" class="form-label ">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label ">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="*******">
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-outline-success" name="login" type="submit">Login</button>
                                </div>
                        </form>
                        <div class="mt-4">
                            <p class="mb-0 text-center">Don't have an account?
                                <a href="register.php" class="text-primary fw-bold">Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "layouts/footer.php"; ?>