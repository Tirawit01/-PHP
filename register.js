document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function(event) {
        event.preventDefault(); // ป้องกันการส่งฟอร์ม

        // คุณสามารถเพิ่มการตรวจสอบข้อมูลหรือบันทึกข้อมูลได้ที่นี่

        // แสดงข้อความแจ้งเตือน
        alert("สมัครสมาชิกเสร็จเรียบร้อยแล้ว!");

        // เปลี่ยนไปยังหน้า login.php
        setTimeout(() => {
            window.location.href = 'login.php'; // เปลี่ยนหน้าไปยัง login.php
        }, 1000); // หน่วงเวลา 1 วินาทีก่อนเปลี่ยนหน้า
    });
});

// script.js

document.addEventListener("DOMContentLoaded", function() {
    // เพิ่มการทำงานของ fade-in เมื่อโหลดหน้า
    document.body.classList.add('fade-in');
});

// เพิ่ม event listener สำหรับลิงค์ที่มีการเปลี่ยนหน้า
const links = document.querySelectorAll('a');

links.forEach(link => {
    link.addEventListener('click', function(event) {
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

// script.js

window.addEventListener('DOMContentLoaded', (event) => {
    // ค้นหาองค์ประกอบที่มีคลาส fade-in
    const fadeElements = document.querySelectorAll('.fade-in');
    
    // เพิ่มคลาส show ให้กับแต่ละองค์ประกอบ
    fadeElements.forEach((element, index) => {
        setTimeout(() => {
            element.classList.add('show'); // เพิ่มคลาส show เพื่อให้แสดงผล
        }, index * 300); // ทำให้แต่ละองค์ประกอบโผล่ขึ้นมาทีละ 300ms
    });
});
