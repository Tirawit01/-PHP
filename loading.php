<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading</title>
    <link rel="icon" type="image/png" href="https://media.discordapp.net/attachments/1292356178818371725/1292444613839421531/44729.webp?ex=6703c258&is=670270d8&hm=9fefa7bf0e2e7aeeb851fd8c20e1e471da908aea8f04ffdbc50fd132afc99637&=&format=webp&width=960&height=421">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <script src="loading.js"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .loader-container {
            text-align: center;
        }
        .logo {
            width: 150px; /* ปรับขนาดโลโก้ตามต้องการ */
            margin-bottom: 20px;
            animation: float 2s ease-in-out infinite; /* เพิ่มการเคลื่อนไหว */
        }
        .loader {
            border: 16px solid #f3f3f3; /* สีพื้นหลังของวงกลม */
            border-top: 16px solid #d60d0d; /* สีของส่วนที่หมุน */
            border-radius: 50%;
            width: 60px; /* ขนาดวงกลม */
            height: 60px; /* ขนาดวงกลม */
            animation: spin 2s linear infinite; /* การหมุน */
            margin: 20px auto; /* จัดกลาง */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        p {
            font-size: 20px;
            color: #fcfcfc;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="loader-container">
        <img src="/img/logo2.png" alt="โลโก้" class="logo">
        <div class="loader"></div>
        <p>กำลังโหลดข้อมูล...</p>
    </div>
</body>
</html>
