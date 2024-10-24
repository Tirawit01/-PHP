document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // ป้องกันการส่งฟอร์ม

        // ดึงค่าจากฟิลด์
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // ตรวจสอบข้อมูล (ที่นี่เราตรวจสอบชื่อผู้ใช้และรหัสผ่านเบื้องต้น)
        if (username === "user" && password === "pass") {
            alert("เข้าสู่ระบบสำเร็จ!"); // แจ้งผู้ใช้ว่าล็อกอินสำเร็จ
            // เปลี่ยนไปยังหน้าแรกหรือหน้าที่ต้องการหลังจากเข้าสู่ระบบสำเร็จ
            window.location.href = 'index.php';
        } else {
            alert("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!"); // แจ้งผู้ใช้ว่าข้อมูลไม่ถูกต้อง
        }
    });
});

// script.js

document.addEventListener("DOMContentLoaded", function () {
    // เพิ่มการทำงานของ fade-in เมื่อโหลดหน้า
    document.body.classList.add('fade-in');
});

// เพิ่ม event listener สำหรับลิงค์ที่มีการเปลี่ยนหน้า
const links = document.querySelectorAll('a');

links.forEach(link => {
    link.addEventListener('click', function (event) {
        event.preventDefault(); // หยุดการทำงานปกติของลิงค์
        const targetUrl = this.getAttribute('href');

        // เริ่มการ fade-out
        document.body.classList.remove('fade-in');
        document.body.classList.add('fade-out');

        // รอให้การ fade-out เสร็จสิ้นก่อนที่จะเปลี่ยนหน้า
        setTimeout(() => {
            window.location.href = targetUrl; // เปลี่ยนหน้า
        }, 500); // ค่าตรงกับเวลาใน CSS transition
    });
});