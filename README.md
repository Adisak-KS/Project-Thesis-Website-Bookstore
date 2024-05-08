# 📖 Project Bookstore (เว็บไซต์ซื้อขายหนังสือออนไลน์)

###### ✍️แก้ไขเมื่อ : 07/03/2567

###### 👨‍💻ผู้จัดทำ : Tharit, Adisak

---

เป็นโปรเจ็คจบปริญญาตรี ด้วย PHP (MySQLi) สามารถดูตัวอย่างเว็บไซต์ได้ [ที่นี่](https://github.com/Adisak-KS/Project-Website-Bookstore/tree/main/previews_bookstore/img) หรือ ไฟล์รายงาน PDF [ที่นี่](https://github.com/Adisak-KS/Project-Website-Bookstore/blob/main/previews_bookstore/Document/00_%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%9E%E0%B8%B1%E0%B8%92%E0%B8%99%E0%B8%B2%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A%E0%B9%84%E0%B8%8B%E0%B8%95%E0%B9%8C%E0%B8%82%E0%B8%B2%E0%B8%A2%E0%B8%AB%E0%B8%99%E0%B8%B1%E0%B8%87%E0%B8%AA%E0%B8%B7%E0%B8%AD%E0%B8%AD%E0%B8%AD%E0%B8%99%E0%B9%84%E0%B8%A5%E0%B8%99%E0%B9%8C.pdf)

---

### ⭐ ระบบภายในเว็บไซต์

        1. 👮ผู้ใช้ระดับผู้ดูแลระบบสูงสุด (Super Admin)
            ✅ สามารถ login เข้าสู่ระบบได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลผู้ดูแลระบบได้
            ✅ สามารถเปิดและระงับสถานะผู้ดูแลระบบได้
            ✅ สามารถแก้ไขข้อมูลส่วนตัวได้
            ✅ สามารถแก้ไขรหัสผ่านตนเองได้
            ✅ สามารถตรวจสอบยอดขาย และ Export ไฟล์ Excel ได้
            ✅ สามารถ Logout ออกจากระบบได้

        2. 👮ผู้ใช้ระดับผู้ดูแลระบบ (Admin)
            ✅ สามารถ Login เข้าสู่ระบบได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลทีมงานได้
            ✅ สามารถกำหนดสิทธิ์ทีมงานได้
            ✅ สามารถกำหนดสถานะทีมงานได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลสมาชิกได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลประเภทสินค้าได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลสำนักพิมพ์ได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลสินค้าได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลโปรโมชันได้
            ✅ สามารถกำหนดโปรโมชันให้สินค้าได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลช่องทางชำระเงินได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลช่องทางการขนส่งได้
            ✅ สามารถแก้ไขการตั้งค่าเว็บไซต์ได้
            ✅ สามารถแก้ไขข้อมูลส่วนตัวได้
            ✅ สามารถแก้ไขรหัสผ่านตนเองได้
            ✅ สามารถจัดการรายละเอียดการชำระเงินได้
            ✅ สามารถเพิ่ม แก้ไข หมายเลขติดตามพัสดุได้
            ✅ สามารถจัดการรายการตามหาหนังสือตามสั่งได้
            ✅ สามารถจัดการความคิดเห็นได้
            ✅ สามารถจัดการสินค้าคงเหลือได้
            ✅ สามารถตรวจสอบยอดขายทั้งหมดได้
            ✅ สามารถ Logout ออกจากระบบได้

        3. 👮ผู้ใช้ระดับฝ่ายขาย (Sale)
            ✅ สามารถ Login เข้าสู่ระบบได้
            ✅ สามารถแก้ไขข้อมูลส่วนตัวได้
            ✅ สามารถแก้ไขรหัสผ่านตนเองได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลสินค้าได้
            ✅ สามารถจัดการรายละเอียดการชำระเงินได้
            ✅ สามารถเพิ่ม แก้ไข หมายเลขติดตามพัสดุได้
            ✅ สามารถจัดการรายการตามหาหนังสือตามสั่งได้
            ✅ สามารถจัดการสินค้าคงเหลือได้
            ✅ สามารถตรวจสอบยอดขายทั้งหมดได้
            ✅ สามารถ Logout ออกจากระบบได้

        3. 👮ผู้ใช้ระดับทีมงาน (Staff)

            ✅ สามารถ Login เข้าสู่ระบบได้
            ✅ สามารถแก้ไขข้อมูลส่วนตัวได้
            ✅ สามารถแก้ไขรหัสผ่านตนเองได้
            ✅ สามารถจัดการรายละเอียดการชำระเงินได้
            ✅ สามารถเพิ่ม แก้ไข หมายเลขติดตามพัสดุได้
            ✅ สามารถจัดการรายการตามหาหนังสือตามสั่งได้
            ✅ สามารถตรวจสอบยอดขายทั้งหมดได้
            ✅ สามารถ Logout ออกจากระบบได้

        4. 🙎‍♂️ผู้ใช้ระดับสมาชิก (Member)
            ✅ สามารถ Login เข้าสู่ระบบได้
            ✅ สามารถค้นหาสินค้าได้
            ✅ สามารถดูรายละเอียดสินค้าได้
            ✅ สามารถดูและเพิ่มความคิดเห็นเกี่ยวกับสินค้าได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลสินค้าในตะกร้าได้
            ✅ สามารถใช้เหรียญเป็นส่วนลดได้
            ✅ สามารถเลือกที่อยู่จัดส่งชั่วคราวได้
            ✅ สามารถยกเลิกคำสั่งซื้อก่อนชำระเงินได้
            ✅ สามารถแจ้งหลักฐานการชำระเงินได้
            ✅ สามารถตรวจสอบประวัติการสั่งซื้อได้
            ✅ สามารถสั่งซื้อสินค้ารายการเดิมอีกครั้งได้
            ✅ สามารถแก้ไขข้อมูลส่วนตัวได้
            ✅ สามารถแก้ไขรหัสผ่านตนเองได้
            ✅ สามารถเพิ่ม แก้ไข ลบข้อมูลที่อยู่ได้
            ✅ สามารถเพิ่ม ลบสินค้าในรายการสิ่งที่อยากได้ได้
            ✅ สามารถคัดลอก URL ของสินค้าได้
            ✅ สามารถเลือกดูสินค้าสินค้าพรีออเดอร์ได้
            ✅ สามารถหาหนังสือตามสั่งได้
            ✅ สามารถดูประวัติการหาหนังสือตามสั่งได้
            ✅ สามารถโอนเหรียญให้กับสมาชิกได้
            ✅ สามารถดูประวัติการโอนเหรียญได้
            ✅ สามารถตรวจสอบหมายเลขพัสดุได้
            ✅ สามารถยืนยันรับสินค้าได้
            ✅ สามารถติดต่อผู้ดูแลระบบได้
            ✅ สามารถ Logout ออกจากระบบได้

        5. 👥ผู้ใช้ระดับทั่วไป (User)
            ✅ สามารถสมัครสมาชิกได้
            ✅ สามารถค้นหาสินค้าได้
            ✅ สามารถดูรายละเอียดสินค้าได้
            ✅ สามารถติดต่อผู้ดูแลระบบได้

---

### ✍️ ภาษาที่ใช้ในการพัฒนาระบบ

        1. HTML
        2. CSS
        3. JavaScript
        4. Bootstrap5
        5. PHP (MySQLi)
        6. MySQL
        9. DataTables

---

### 🛠️ เครื่องมือที่ใช้

        1. Visual Studio Code
        2. WampServer

---

### 📥วิธีติดตั้งเว็บไซต์

    1. นำ Database ในโฟลเดอร์ Database/bookstore.sql ไปติดตั้งใน Wamp หรือ Xampp [คลิก]
    2. นำ โฟลเดอร์ bookstore ไปวางไว้ภายในเครื่องตนเอง
    3. หากมี Error เกี่ยวกับ Database ให้ตรวจสอบที่ connection.php ที่ username หรือ password

---

### 🕯️วิธีเข้าใช้งาน

    1. เข้าใช้งานระดับสมาชิกและผู้ใช้ทั่วไป(Member & User) ที่ http://localhost/bookstore/
    2. เข้าใช้งานระดับผู้ดูแลระบบ (Admin) โดยเข้าที่ http://localhost/bookstore/admin_page/Admin/dist/login_form.php

---

### 📑ข้อมูล Login เริ่มต้น

    1. ผู้ดูแลระบบสูงสุด (Super Admin)
        Username : superadmin
        Password : adm

    2. ผู้ดูแลระบบ (Admin)
        Username : Admin1
        Password : Admin111
        
    3. สมาชิก (Member)
        Username : Adisak123
        Password : Adisak123

---

### 💻 ตัวอย่างเว็บไซต์

1. หน้าแรกของเว็บไซต์

![index](https://github.com/Adisak-KS/Project-Website-Bookstore/blob/main/previews_bookstore/img/member/01_index.png)

2. หน้าตะกร้าสินค้า

![index](https://github.com/Adisak-KS/Project-Website-Bookstore/blob/main/previews_bookstore/img/member/06_wishlist.png)

3. หน้าบัญชีของฉัน

![index](https://github.com/Adisak-KS/Project-Website-Bookstore/blob/main/previews_bookstore/img/member/06_wishlist.png)

4. หน้าแรกของผู้ดูแลระบบ

![index](https://github.com/Adisak-KS/Project-Website-Bookstore/blob/main/previews_bookstore/img/admin/07_index_admin.png)

5. หน้าตั้งค่าเว็บไซต์

![index](https://github.com/Adisak-KS/Project-Website-Bookstore/blob/main/previews_bookstore/img/admin/12_setting_web.png)
