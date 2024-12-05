## Các bước cài đặt project
### Bước 1: Nếu chưa bật extension gd và zip thì tìm file php.ini rồi xóa dấu ; trước extension
### Bước 2: Mở terminal trỏ đến project rồi chạy lệnh
```sh
composer update --ignore-platform-reqs
```
### Bước 3: Chạy tiếp lệnh
```sh
composer install --ignore-platform-reqs
```
### Bước 4: Chạy tiếp lệnh
```sh
npm install
```
### Bước 5: Chạy tiếp lệnh
```sh
npm run build
```
### Bước 6: Sửa thông tin trong file .env
### Bước 7: Chạy lệnh sau để migrate dữ liệu lên database
```sh
php artisan migrate
```
### Bước 8: Chạy lệnh sau, nếu báo lỗi không tìm thấy folder npm thì vào AppData/Roaming tạo 1 folder tên là npm
```sh
composer run dev
```

