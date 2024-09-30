<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header('Location: index.php');
    exit();
}

$user_data = $_SESSION['user_data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About User</title>
    
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
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.3s ease;
        }
        .form-label {
            font-weight: 600;
            font-size: 1.1rem;
            color: #264e70;
        }
        input {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 100%;
        }
        input:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            border-color: #007bff;
        }
        .text-danger {
            font-size: 0.875rem;
        }
        textarea {
            resize: none;
            border-radius: 5px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
        }
        .btn-primary {
            background: #679186;
            color: white; 
            border: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: all 0.4s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background: #5b6e58; 
            color: white;
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
            transform: translateY(-3px);
        }
        h2 {
            font-weight: 700;
            font-size: 1.8rem;
            color: #264e70; 
            margin-bottom: 1.5rem;
        }  
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
                <h2 class="text-center">Your Details</h2>

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook URL:</label>
                    <input type="url" id="facebook" name="facebook" value="<?php echo htmlspecialchars($user_data['facebook']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($user_data['gender']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country:</label>
                    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user_data['country']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label">Skills:</label>
                    <input type="text" id="skills" name="skills" value="<?php echo implode(', ', $user_data['skills']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="biography" class="form-label">Biography:</label>
                    <textarea id="biography" name="biography" readonly style="height: auto;"><?php echo htmlspecialchars($user_data['biography']); ?></textarea>
                </div>

                <div class="mb-3">
                <a href="index.php" class="btn btn-primary">Back</a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>