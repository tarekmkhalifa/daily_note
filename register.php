<?php
// Header
$pageTitle = "Register";
require_once "layouts/header.php";
// Middleware
require_once("app/middleware/guest.php");

require_once "app/models/User.php";
// Register Process
if (isset($_POST['register'])) {
    $errors = [];
    // check on fields
    if (!$_POST['first_name'] || !$_POST['first_name'] || !$_POST['email'] || !$_POST['password'] || !$_POST['password_confirmation']) {
        $errors['fields'] = "All Fields Required";
    }
    if (empty($errors)) {
        // check email already exists in database
        $user = new User;
        $user->setEmail($_POST['email']);
        $exists = $user->checkByEmail();
        if ($exists) {
            $errors['user_exists'] = "Email Already Exists";
        } else {
            $user->setFirst_name($_POST['first_name']);
            $user->setLast_name($_POST['last_name']);
            $user->setPassword($_POST['password']);
            // save user in database
            $user->insertData();
            $newUser = $user->selectData()->fetch_object();
            // Automatically login and save user in session
            $_SESSION['user'] = $newUser;
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
                        <form class="mb-3 mt-md-4" action="register.php" method="POST">
                            <h2 class="fw-bold text-primary text-uppercase text-center mb-4 fst-italic">Daily Notes</h2>
                            <?php
                            if (isset($errors)) { ?>
                                <p class="alert alert-danger text-center">
                                <?php
                                foreach ($errors as $error) {
                                    echo $error;
                                }
                            }
                                ?>
                                <div class="row my-3">
                                    <div class="col-6">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : "" ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : "" ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label ">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label ">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="*******">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label ">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="*******">
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-outline-primary" name="register" type="submit">Register</button>
                                </div>
                        </form>
                        <div class="mt-4">
                            <p class="mb-0 text-center">All Ready Have Account
                                <a href="login.php" class="text-success fw-bold">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "layouts/footer.php"; ?>