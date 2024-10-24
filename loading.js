// เช็คว่าหน้านี้เคยโหลดแล้วหรือยังใน session นี้
if (!sessionStorage.getItem('hasLoaded')) {
    // เช็คว่าไม่อยู่ใน loading.php
    if (!window.location.pathname.endsWith('loading.php')) {
        // บันทึก URL ของหน้าปัจจุบัน
        sessionStorage.setItem('returnUrl', window.location.href);

        // บันทึกว่าเคยแสดงหน้าโหลดแล้ว
        sessionStorage.setItem('hasLoaded', 'true');

        // เปลี่ยนไปที่หน้า loading.php ทันที
        window.location.href = 'loading.php';
    }
}

// สำหรับหน้า loading.php เท่านั้น
if (window.location.pathname.endsWith('loading.php')) {
    window.addEventListener('load', function() {
        // ตั้งเวลา 3 วินาทีแล้วเปลี่ยนเส้นทางกลับไปยังหน้าที่บันทึกไว้
        setTimeout(() => {
            const returnUrl = sessionStorage.getItem('returnUrl');

            // เปลี่ยนเส้นทางกลับไปที่หน้าเดิม หรือ index.php ถ้าไม่มี returnUrl
            window.location.href = returnUrl ? returnUrl : 'index.php';
        }, 2000); // 3 วินาที
    });
}
