<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $facebook = filter_var(trim($_POST['facebook']), FILTER_SANITIZE_URL);
    $gender = $_POST['gender'] ?? '';
    $country = $_POST['country'] ?? ''; 
    $skills = $_POST['skills'] ?? [];
    $biography = filter_var(trim($_POST['biography']), FILTER_SANITIZE_STRING);

   
    if (empty($name)) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = "Only letters and white space allowed.";
    }

  
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

 
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[A-Z]).{8,}$/', $password)) {
        $errors['password'] = "Password must be at least 8 characters long, contain 1 uppercase letter and 1 number.";
    }


    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Please confirm your password.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

   
    if (empty($phone)) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match('/^09[0-9]{9}$/', $phone)) {
        $errors['phone'] = "Invalid phone number. Must be numeric.";
    }

    
    if (empty($facebook)) {
        $errors['facebook'] = "Facebook URL is required.";
    } elseif (!filter_var($facebook, FILTER_VALIDATE_URL)) {
        $errors['facebook'] = "Invalid Facebook URL format.";
    }


    if (empty($gender)) {
        $errors['gender'] = "Gender is required.";
    }


    if (empty($country)) {
        $errors['country'] = "Country is required.";
    }

  
    if (empty($skills)) {
        $errors['skills'] = "Please select at least one skill.";
    }

   
    if (empty($biography)) {
        $errors['biography'] = "Biography is required.";
    } elseif (strlen($biography) > 200) {
        $errors['biography'] = "Biography must not exceed 200 characters.";
    }

    
    if (empty($errors)) {
        $_SESSION['user_data'] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'facebook' => $facebook,
            'gender' => $gender,
            'country' => $country,
            'skills' => $skills,
            'biography' => $biography
        ];
        header('Location: about.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #fdebd3 0%, #f9b4ab 100%);
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 80px;
            max-width: 600px;
        }
        .card {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        .form-label {
            font-weight: 600;
            font-size: 1.1rem;
            color: #264e70; 
        }
        .btn-primary {
            background: #679186; 
            border: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: all 0.4s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background: #5b6e58; 
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
            transform: translateY(-3px);
        }
        .text-danger {
            font-size: 0.875rem;
            color: #cc3333; 
        }
        textarea {
            resize: none;
        }
        input, select, textarea {
            border-radius: 5px;
            background-color: #bbd4ce;
        }
        input:focus, select:focus, textarea:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            border-color: #679186; 
        }
        .gender-radio input[type="radio"] {
            margin-right: 5px;
        }
        h2 {
            font-weight: 700;
            font-size: 1.8rem;
            color: #264e70; 
            margin-bottom: 1.5rem;
        }
        .form-check-label {
            margin-left: 8px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center">Registration Form</h2>
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>">
                    <div class="text-danger"><?php echo $errors['name'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>">
                    <div class="text-danger"><?php echo $errors['email'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="text-danger"><?php echo $errors['password'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    <div class="text-danger"><?php echo $errors['confirm_password'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES); ?>">
                    <div class="text-danger"><?php echo $errors['phone'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook URL:</label>
                    <input type="url" class="form-control" id="facebook" name="facebook" value="<?php echo htmlspecialchars($_POST['facebook'] ?? '', ENT_QUOTES); ?>">
                    <div class="text-danger"><?php echo $errors['facebook'] ?? ''; ?></div>
                </div>

                <div class="mb-3 gender-radio">
                    <label class="form-label">Gender:</label><br>
                    <label><input type="radio" name="gender" value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'checked' : ''; ?>> Male</label>
                    <label><input type="radio" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'checked' : ''; ?>> Female</label>
                    <div class="text-danger"><?php echo $errors['gender'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country:</label>
                    <select class="form-select" id="country" name="country">
                        <option value="">Select Country</option>
                        <option value="USA" <?php echo (isset($_POST['country']) && $_POST['country'] == 'USA') ? 'selected' : ''; ?>>USA</option>
                        <option value="Canada" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Canada') ? 'selected' : ''; ?>>Canada</option>
                        <option value="Japan" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Japan') ? 'selected' : ''; ?>>Japan</option>
                        <option value="Philippines" <?php echo (isset($_POST['country']) && $_POST['country'] == 'Philippines') ? 'selected' : ''; ?>>Philippines</option>
                        <option value="UK" <?php echo (isset($_POST['country']) && $_POST['country'] == 'UK') ? 'selected' : ''; ?>>UK</option>
                    </select>
                    <div class="text-danger"><?php echo $errors['country'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Skills:</label><br>
                    <label><input type="checkbox" name="skills[]" value="PHP" <?php echo (isset($_POST['skills']) && in_array('PHP', $_POST['skills'])) ? 'checked' : ''; ?>> PHP</label>
                    <label><input type="checkbox" name="skills[]" value="JavaScript" <?php echo (isset($_POST['skills']) && in_array('JavaScript', $_POST['skills'])) ? 'checked' : ''; ?>> JavaScript</label>
                    <label><input type="checkbox" name="skills[]" value="CSS" <?php echo (isset($_POST['skills']) && in_array('CSS', $_POST['skills'])) ? 'checked' : ''; ?>> CSS</label>
                    <div class="text-danger"><?php echo $errors['skills'] ?? ''; ?></div>
                </div>

                <div class="mb-3">
                    <label for="biography" class="form-label">Biography:</label>
                    <textarea class="form-control" id="biography" name="biography" maxlength="200"><?php echo htmlspecialchars($_POST['biography'] ?? '', ENT_QUOTES); ?></textarea>
                    <div class="text-danger"><?php echo $errors['biography'] ?? ''; ?></div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
