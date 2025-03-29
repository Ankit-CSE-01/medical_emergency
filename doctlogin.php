<?php
require_once 'includes/header.php';
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE email = ?");
    $stmt->execute([$email]);
    $doctor = $stmt->fetch();

    if ($doctor && password_verify($password, $doctor['password'])) {
        $_SESSION['doctor_id'] = $doctor['id'];
        $_SESSION['doctor_name'] = $doctor['name'];
        $_SESSION['doctor_email'] = $doctor['email'];
        header("Location: doctor/dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Doctor Login</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div class="mt-3">
                    <p>Don't have an account? <a href="signup.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>