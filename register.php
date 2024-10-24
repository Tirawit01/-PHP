<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* เพิ่มเพื่อกำจัดการ margin ที่อาจเกิดขึ้น */
        }

        .register-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s ease;
            position: relative; /* แก้ไขเพื่อใช้ตำแหน่งสัมพัทธ์กับลิงค์ */
        }

        .register-container:hover {
            transform: translateY(-5px);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #e53935;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #e53935;
            box-shadow: 0 0 8px rgba(233, 57, 53, 0.5);
            outline: none; /* หลีกเลี่ยงการใช้ outline */
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #e53935;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #c62828;
            transform: translateY(-3px);
        }

        .link {
            position: absolute; /* ทำให้ตำแหน่งเป็นแบบสัมพัทธ์ */
            top: 20px;
            left: 20px;
            text-align: center;
            color: #e53935;
            transition: color 0.3s ease;
        }

        .link a {
            text-decoration: none;
            color: #e53935;
            font-weight: bold;
        }

        .link a:hover {
            color: #c62828;
        }
    </style>
</head>

<body>

    <div class="register-container">
        <h2>สมัครสมาชิก</h2>
        <form id="registerForm" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="อีเมล" name="email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn-primary">สมัครสมาชิก</button>
        </form>
    </div>

    <?php
    // เชื่อมต่อฐานข้อมูล
    include 'config.php';  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // ตรวจสอบชื่อผู้ใช้ซ้ำ
        $checkStmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $checkStmt->bindParam(':username', $username);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            echo "<script>
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด!',
                    text: 'ชื่อผู้ใช้ซ้ำ!',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            </script>";
        } elseif ($password !== $confirmPassword) {
            echo "<script>
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด!',
                    text: 'รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            </script>";
        } else {
            // Hashing the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({
                    title: 'สมัครสมาชิกสำเร็จ!',
                    text: 'ยินดีต้อนรับ $username ขอบคุณที่เข้าร่วมกับเรา',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'login.php'; // เปลี่ยนที่อยู่ URL ไปยังหน้าล็อกอิน
                    }
                });
            </script>";
            
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด!',
                        text: 'ไม่สามารถสมัครสมาชิกได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                </script>";
            }
        }
    }
    ?>
</body>

</html>
