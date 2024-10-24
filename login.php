<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      /* for register.html */
      body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background-color 0.3s ease;
            transition: opacity 0.5s ease-in-out;
        }
        
        .fade-out {
            opacity: 0;
        }
        
        .fade-in {
            opacity: 1;
        }
        
        .register-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s ease;
        }
        
        .register-container:hover {
            transform: translateY(-5px);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fb00ff;
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
            border-color: #5500c3;
            box-shadow: 0 0 8px rgba(179, 0, 255, 0.5);
        }
        
        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #cb1fff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #a200ff;
            transform: translateY(-3px);
        }
        
        .link {
            text-align: center;
            margin-top: 10px;
            color: #c800ff;
            transition: color 0.3s ease;
        }
        
        .link a {
            text-decoration: none;
            color: #ae00ff;
            font-weight: bold;
        }
        
        .link a:hover {
            color: #a600ff;
        }
    </style>
</head>
<body>

    <div class="login-container">
    <div class="link" style="position: absolute; top: 20px; left: 20px;">
        <a href="index.php">กลับสู่หน้าแรก</a>
    </div>

        <h2>เข้าสู่ระบบ</h2>
        <form id="loginForm" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" required>
            </div>
            <button type="submit" class="btn-primary">เข้าสู่ระบบ</button>
        </form>
        <div class="link">
            <a href="register.php">สมัครสมาชิก</a>
        </div>
    </div>

 <?php
// เชื่อมต่อฐานข้อมูล
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เตรียมคำสั่ง SQL เพื่อตรวจสอบผู้ใช้
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // ตรวจสอบว่าพบผู้ใช้หรือไม่
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // เข้าสู่ระบบสำเร็จ
            session_start();
            $_SESSION['username'] = $username;

            // แจ้งเตือนเข้าสู่ระบบสำเร็จ
            echo "<script>
                Swal.fire({
                    title: 'เข้าสู่ระบบสำเร็จ!',
                    text: 'ยินดีต้อนรับคุณ, $username',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
                        if ('{$user['role']}' === 'admin') {
                            window.location.href = 'admin/index.php'; // เปลี่ยนเป็นหน้าผู้ดูแลระบบ
                        } else {
                            window.location.href = 'index.php'; // เปลี่ยนเป็นหน้าผู้ใช้
                        }
                    }
                });
            </script>";
            exit();
        } else {
            echo "<script>
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด!',
                    text: 'รหัสผ่านไม่ถูกต้อง',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด!',
                text: 'ชื่อผู้ใช้ไม่ถูกต้อง',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        </script>";
    }
}
?>

</body>
</html>
