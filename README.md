# 📝 Phú Xuân Blog

Blog app xây dựng với Laravel – Bài tập môn IT3042 Đại học Phú Xuân.

## ✨ Tính năng

- Quản lý bài viết (CRUD)
- Danh mục, Tag, Bình luận
- Tìm kiếm, lọc danh mục, sắp xếp
- Phân trang 10 bài/trang
- Xóa mềm (Soft Delete) và khôi phục

## 🚀 Cài đặt

```bash
# 1. Clone repository
git clone https://github.com/Nguyen-Gia-Bao-112/phu-xuan-blog.git
cd phu-xuan-blog

# 2. Cài dependencies
composer install

# 3. Tạo file .env
cp .env.example .env

# 4. Tạo application key
php artisan key:generate

# 5. Cấu hình database trong .env
# DB_DATABASE=phu_xuan_blog
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Chạy migration và seed dữ liệu mẫu
php artisan migrate:fresh --seed

# 7. Chạy server
php artisan serve