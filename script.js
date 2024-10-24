document.addEventListener('DOMContentLoaded', function () {
    const fadeElements = document.querySelectorAll('.fade-in');

    // ทำให้ body ค่อยๆ ปรากฏ
    document.body.style.opacity = 0;
    setTimeout(() => {
        document.body.style.opacity = 1; // ทำให้ body ค่อยๆ ปรากฏ
        fadeElements.forEach(el => {
            el.classList.add('visible'); // ทำให้เนื้อหาปรากฏ
        });
    }, 100); // หน่วงเวลาเล็กน้อย

    function checkFade() {
        const triggerBottom = window.innerHeight / 5 * 4;

        fadeElements.forEach(el => {
            const boxTop = el.getBoundingClientRect().top;

            if (boxTop < triggerBottom) {
                el.classList.add('visible'); // ทำให้เนื้อหาปรากฏขึ้น
            } else {
                el.classList.remove('visible'); // ซ่อนเนื้อหาหากอยู่ด้านล่าง
            }
        });
    }

    window.addEventListener('scroll', checkFade);
    window.addEventListener('resize', checkFade);
    checkFade(); // ตรวจสอบการแสดงผลเมื่อโหลดหน้า

    // การเปลี่ยนหน้า
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
            }, 200); // ค่าตรงกับเวลาใน CSS transition
        });
    });
});




