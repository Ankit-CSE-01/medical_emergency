<?php
require_once 'includes/header.php';
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $specialization = $_POST['specialization'];
    $license = $_POST['license'];
    $phone = $_POST['phone'];

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM doctors WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error = "Email already registered";
    } else {
        // Insert new doctor
        $stmt = $pdo->prepare("INSERT INTO doctors (name, email, password, specialization, license_number, phone) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $password, $specialization, $license, $phone])) {
            $success = "Registration successful! Please login.";
            header("refresh:2;url=login.php");
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Doctor Registration</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" required>
                    </div>
                    <div class="mb-3">
                        <label for="license" class="form-label">Medical License Number</label>
                        <input type="text" class="form-control" id="license" name="license" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <div class="mt-3">
                    <p>Already registered? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>