# CHƯƠNG 3: CÔNG NGHỆ SỬ DỤNG

## 3.1. Giới thiệu tổng quan

Hệ thống quản lý đặt sân bóng được xây dựng kết hợp các công nghệ như backend framework Laravel, database MySQL, frontend Blade template kết hợp Tailwind CSS. Các công nghệ được lựa chọn nhằm đáp ứng các yêu cầu chức năng đã nêu trong Chương 2, bao gồm quản lý người dùng, đặt sân bóng, quản lý thông tin sân, xử lý thanh toán,...

## 3.2. Backend Framework - Laravel 12

### 3.2.1. Mục đích và vai trò

Laravel là một web framework PHP hiện đại, xây dựng theo mô hình MVC (Model-View-Controller), cung cấp các công cụ mạnh mẽ để phát triển ứng dụng web toàn vẹn. Trong dự án này, Laravel được sử dụng để:

- **Xử lý logic ứng dụng**: Thông qua các Controller quản lý các chức năng như đặt sân bóng, quản lý khách hàng, nhân viên, thanh toán
- **Định tuyến (Routing)**: Xây dựng các route RESTful cho giao diện quản trị (`admin.php`), khách hàng (`customer.php`), và công khai (`web.php`)
- **Xác thực và phân quyền**: Sử dụng Laravel Guards và Policies để kiểm soát truy cập cho các vai trò khác nhau (quản trị viên, nhân viên, khách hàng)
- **Validation & Authorization**: Xác thực request từ client thông qua các Form Request classes

### 3.2.2. Liên kết với Chương 2 (Yêu cầu)

Các yêu cầu từ Chương 2 được giải quyết bởi các thành phần Laravel:

| Yêu cầu | Giải pháp Laravel |
|--------|------------------|
| Quản lý CRUD cho các entity (sân bóng, khách hàng, nhân viên) | Laravel Resource Controllers |
| Xếp hàng, lọc, tìm kiếm dữ liệu | Eloquent Query Builder, Scope |
| Phân quyền người dùng (admin, nhân viên, khách hàng) | Laravel Guards, Policies, Middleware |
| Xác thực thông tin đầu vào | Form Request Classes, Validation Rules |
| Quản lý các trạng thái booking | Controller logic + Model states |

### 3.2.3. Các lựa chọn thay thế

- **Symfony**: Framework PHP mạnh mẽ, linh hoạt hơn nhưng học cao hơn. Thích hợp cho ứng dụng cực kỳ phức tạp
- **Django (Python)**: Framework Python phổ biến, cộng đồng lớn, nhưng đòi hỏi chuyển đổi ngôn ngữ
- **ASP.NET Core (C#)**: Framework hiệu suất cao, thích hợp cho enterprise applications, năng lượng tiêu thụ cao hơn

### 3.2.4. Lý do chọn Laravel

1. **Đường cong học tập mềm**: Cú pháp rõ ràng, dễ học, tài liệu phong phú
2. **Tích hợp sẵn**: Cung cấp authentication, authorization, validation, migrations tích hợp ngay trong framework
3. **Elequent ORM**: Cung cấp cách viết code database-agnostic, dễ bảo trì
4. **Convention over Configuration**: Tuân theo quy ước, ít cấu hình, tập trung vào logic ứng dụng
5. **Phát triển nhanh**: Artisan CLI giúp sinh ra code boilerplate tự động

## 3.3. Database - MySQL với Eloquent ORM

### 3.3.1. Mục đích và vai trò

Database MySQL lưu trữ toàn bộ dữ liệu của hệ thống. Dự án sử dụng Eloquent ORM (Object-Relational Mapping) từ Laravel để tương tác với database theo cách hướng đối tượng, thay vì viết raw SQL.

Struktur database bao gồm các bảng chính:

- **users**: Lưu thông tin người dùng (admin, staff), bao gồm username, email, password (đã mã hóa), role
- **customers**: Lưu thông tin khách hàng (tên, số điện thoại, email)
- **employees**: Lưu thông tin nhân viên (tên, địa chỉ, số điện thoại, liên kết với user)
- **fields**: Lưu thông tin sân bóng (tên, địa chỉ, giá trị trạng thái hoạt động)
- **field_types**: Lưu loại sân (5x5, 7x7, v.v.)
- **time_slots**: Lưu khung giờ mở cửa (08:00-09:00, 09:00-10:00, v.v.)
- **field_prices**: Lưu giá sân theo loại sân và khung giờ (giá cao điểm, giá thường)
- **bookings**: Lưu thông tin đặt sân (ngày đặt, sân, khung giờ, khách hàng, trạng thái)
- **bills**: Lưu hóa đơn thanh toán (liên kết với booking, phương thức thanh toán)
- **payment_methods**: Lưu phương thức thanh toán (tiền mặt, chuyển khoản, v.v.)
- **images**: Lưu ảnh sân bóng (liên kết với field)

### 3.3.2. Liên kết với Chương 2 (Yêu cầu)

| Yêu cầu | Giải pháp Database |
|--------|-----------------|
| Lưu trữ thông tin sân, loại sân, khung giờ | Bảng fields, field_types, time_slots |
| Quản lý đặt sân có kiểm tra xung đột khung giờ | Bảng bookings với index (field_id, bookingDate, time_id) |
| Lưu thông tin khách hàng, nhân viên | Bảng customers, employees, users |
| Quản lý thanh toán, hóa đơn | Bảng bills, payment_methods với foreign key |
| Tính giá động theo khung giờ và loại sân | Bảng field_prices với mối quan hệ many-to-many |
| Lưu ảnh sân | Bảng images với liên kết đến fields |

### 3.3.3. Các lựa chọn thay thế

- **PostgreSQL**: Database mạnh mẽ, hỗ trợ JSON type, nhưng phức tạp hơn là MySQL cho project nhỏ-vừa
- **MongoDB**: NoSQL database, linh hoạt với sơ đồ động, nhưng khó để implement validation kinh doanh phức tạp
- **SQLite**: Nhẹ, không cần server, phù hợp cho mobile hoặc embedded, nhưng không scalable cho multi-user

### 3.3.4. Lý do chọn MySQL

1. **Phổ biến và ổn định**: MySQL là database relational phổ biến nhất, ổn định, được hỗ trợ tốt
2. **Phù hợp với kiến trúc dữ liệu**: Dữ liệu có tính cấu trúc cao, mối quan hệ phức tạp giữa các entity, MySQL phù hợp hơn NoSQL
3. **Performance**: Với index đúng (ví dụ index trên bookings table), MySQL đạt performance tốt
4. **Dễ backup, restore**: MySQL hỗ trợ backup/restore đơn giản, dễ triển khai
5. **Hỗ trợ Eloquent ORM tốt**: Laravel built-in hỗ trợ MySQL một cách tốt nhất

## 3.4. Frontend - Blade Templates, Tailwind CSS, Tom Select

### 3.4.1. Blade Templates - Engine cấu trúc giao diện

**Mục đích**: Blade là view engine của Laravel, cho phép viết giao diện động với PHP embedded trong HTML.

**Ứng dụng trong dự án**:
- Giao diện quản trị (admin panel) với các trang CRUD cho sân bóng, khách hàng, nhân viên
- Giao diện booking cho khách hàng
- Layout chung (header, sidebar, footer) được tái sử dụng qua `@extends` và `@include`
- Hiển thị dữ liệu động từ database thông qua vòng lặp `@foreach`, điều kiện `@if`

**Các lựa chọn thay thế**:
- **React/Vue.js**: Frontend framework hiện đại, phù hợp cho SPA (Single Page Application)
- **Twig**: Template engine mạnh mẽ, có thể dùng với Laravel
- **Thymeleaf**: Dùng cho Java-based frameworks

**Lý do chọn Blade**:
1. **Tích hợp sẵn**: Blade được tích hợp trong Laravel, không cần setup thêm
2. **Đơn giản**: Cú pháp rõ ràng, dễ học cho developer PHP
3. **Hiệu suất**: Blade được compile thành PHP thuần, hiệu suất tốt
4. **CRUD applications**: Cho ứng dụng CRUD truyền thống, Blade đủ mạnh mẽ

### 3.4.2. Tailwind CSS - Framework CSS Utility-First

**Mục đích**: Tailwind CSS cung cấp các utility classes để xây dựng giao diện responsive, hiện đại mà không cần viết CSS riêng.

**Ứng dụng trong dự án**:
- Styling component headers, sidebars, tables, forms
- Responsive design (breakpoints `md:`, `lg:`) để giao diện thích nghi mobile-tablet-desktop
- Thống nhất màu sắc, spacing, typography trên toàn bộ ứng dụng

**Các lựa chọn thay thế**:
- **Bootstrap**: Framework CSS phổ biến, có component built-in, nhưng có thể tạo output CSS lớn
- **Material UI**: Design system Google, component phong phú, nhưng nặng hơn
- **CSS thuần**: Cách truyền thống, đầy đủ điều khiển, nhưng tốn thời gian và dễ lặp lại code

**Lý do chọn Tailwind CSS**:
1. **Utility-first**: Không cần đặt tên class, viết CSS nhanh hơn
2. **Nhẹ**: Chỉ include CSS được dùng thực tế (tree-shaking), output file nhỏ
3. **Customizable**: Dễ cấu hình theme (màu, font, breakpoints)
4. **Responsive-ready**: Hỗ trợ mobile-first, các breakpoint được định sẵn
5. **Trending**: Được sử dụng rộng rãi trong cộng đồng modern web development

### 3.4.3. Tom Select - Component Select nâng cao

**Mục đích**: Tom Select là thư viện JavaScript tạo ra select box nâng cao với tính năng search, multi-select, custom render.

**Ứng dụng trong dự án**:
- Form chọn sân bóng, loại sân, khách hàng, phương thức thanh toán với tính năng tìm kiếm
- Hỗ trợ multi-select cho các trường yêu cầu chọn nhiều item
- Cải thiện UX bằng cách hiển thị dữ liệu đầy đủ, hỗ trợ lọc real-time

**Các lựa chọn thay thế**:
- **Select2**: Thư viện select nổi tiếng, mạnh mẽ, nhưng nặng hơn
- **Choices.js**: Nhẹ hơn, UI đẹp, nhưng feature ít hơn
- **Native HTML Select**: Đơn giản, nhưng UX kém trên một số trường hợp

**Lý do chọn Tom Select**:
1. **Nhẹ**: Kích thước nhỏ (~30KB), tốc độ load nhanh
2. **Feature đầy đủ**: Hỗ trợ search, multi-select, custom render
3. **Không dependency**: Vanilla JavaScript, không phụ thuộc jQuery
4. **Styling**: Dễ styling với CSS/Tailwind

## 3.5. Build Tool - Vite

### 3.5.1. Mục đích và vai trò

Vite là module bundler hiện đại, thay thế Webpack trong các project Laravel đương đại. Vite được sử dụng để:

- **Development**: Cung cấp HMR (Hot Module Replacement), khi developer sửa file CSS/JS sẽ tự động reload browser
- **Production Build**: Minify, tree-shake, split code thành chunks để tối ưu hiệu suất
- **Asset Import**: Import CSS, images, fonts như ES modules trong JavaScript

**Cấu hình trong dự án**:
- File `vite.config.js` define Laravel input/output paths
- `laravel-vite-plugin` helper Laravel app sử dụng Vite-bundled assets
- `@vite()` directive trong Blade template để inject các asset được bundle

### 3.5.2. Liên kết với Chương 2 (Yêu cầu)

| Yêu cầu | Giải pháp Vite |
|--------|--------------|
| Quản lý CSS/JS assets | Bundle CSS/JS thành file tối ưu |
| Tối ưu hiệu suất load page | Minify, tree-shake, lazy-load chunks |
| Hỗ trợ phát triển nhanh | HMR trong development mode |
| Import CSS/JS trong Blade | Cấu hình `@vite` directive |

### 3.5.3. Các lựa chọn thay thế

- **Webpack**: Phức tạp, cấu hình rườm rà, nhưng mạnh mẽ cho dự án rất lớn
- **Parcel**: Zero-config bundler, nhưng ít flexibility
- **Rollup**: Tương tự Vite, nhưng Vite dễ sử dụng hơn cho web projects

### 3.5.4. Lý do chọn Vite

1. **Tốc độ phát triển**: HMR rất nhanh, giúp developer phát triển efficient
2. **Cấu hình tối thiểu**: Vite chỉ require `vite.config.js` đơn giản, không cần setup phức tạp
3. **Output tối ưu**: Tự động tree-shake, minify, tạo source maps cho debugging
4. **Hỗ trợ native**: Laravel 12 hỗ trợ Vite natively thông qua `laravel-vite-plugin`

## 3.6. Xác thực và Phân quyền - Guards & Policies

### 3.6.1. Mục đích

Hệ thống quản lý đặt sân bóng có ba loại người dùng với quyền hạn khác nhau:
- **Quản trị viên (role = 0)**: Toàn quyền quản lý hệ thống
- **Nhân viên (role = 1)**: Quản lý đơn đặt sân, khách hàng ở cấp độ nhất định
- **Khách hàng**: Chỉ xem/sửa thông tin cá nhân, đặt sân

**Giải pháp**: Laravel Guards (xác thực) kết hợp Policies (phân quyền)

### 3.6.2. Guard - Xác thực người dùng

Laravel Guards xác định cách xác thực người dùng:
- Mặc định, hệ thống dùng middleware `auth` để kiểm tra request có session hợp lệ
- Các route trong `admin.php` được bảo vệ bởi middleware `['auth', 'admin']`
- Custom middleware `admin` kiểm tra `auth()->user()->role == 0`

### 3.6.3. Policies - Phân quyền truy cập resource

Policy classes (ví dụ `BookingPolicy`, `FieldPolicy`) định nghĩa các action người dùng được phép thực hiện:

```php
// Ví dụ: BookingPolicy
public function update(User $user, Booking $booking)
{
    return $user->role == 0 || $user->id == $booking->employee_id;
}
```

### 3.6.4. Liên kết với Chương 2 (Yêu cầu)

| Yêu cầu | Giải pháp |
|--------|----------|
| Xác thực người dùng (login/logout) | Laravel Guards + Auth middleware |
| Phân quyền role-based | Custom middleware kiểm tra role |
| Phân quyền granular (ai được sửa booking) | Policies |
| Bảo vệ routes admin | Route middleware |

### 3.6.5. Các lựa chọn thay thế

- **JWT (JSON Web Token)**: Stateless authentication, thích hợp cho API/SPA
- **OAuth2**: Third-party authentication (Google, Facebook login), phức tạp hơn
- **Passport**: OAuth2 server trong Laravel, quá mạnh cho dự án này

### 3.6.6. Lý do chọn Traditional Session + Guards + Policies

1. **Đơn giản**: Session-based authentication là cách truyền thống, dễ hiểu
2. **Bảo mật**: Middleware kiểm tra session CSRF token, chống CSRF attack
3. **Phù hợp**: Cho traditional server-rendered application (Blade template)
4. **Built-in**: Laravel cung cấp sẵn, không cần package thêm

## 3.7. Testing - PHPUnit

### 3.7.1. Mục đích

PHPUnit là framework testing cho PHP, cho phép viết các test cases để kiểm tra tính đúng đắn của code.

**Ứng dụng trong dự án**:
- **Unit tests**: Test các method riêng lẻ của Model, Controller
- **Feature tests**: Test toàn bộ flow (ví dụ: user login -> view booking list -> create booking)

**Lợi ích**:
- Phát hiện bug sớm trước khi deploy
- Tăng confidence khi refactor code
- Tạo living documentation cho codebase

### 3.7.2. Cấu hình trong dự án

File `phpunit.xml` cấu hình:
- Test directory: `tests/`
- Database testing: Sử dụng in-memory database hoặc fresh migration cho mỗi test

### 3.7.3. Các lựa chọn thay thế

- **Pest**: Testing framework PHP hiện đại hơn, cú pháp gọn gàng hơn PHPUnit
- **Behat**: BDD (Behavior-Driven Development) framework, cho high-level scenario testing

### 3.7.4. Lý do chọn PHPUnit

1. **Standard**: PHPUnit là standard trong PHP ecosystem
2. **Integration**: Laravel tích hợp PHPUnit natively
3. **Community**: Tài liệu phong phú, cộng đồng lớn

## 3.8. Các thư viện bổ trợ

### 3.8.1 Axios

**Mục đích**: Thư viện HTTP client JavaScript, dùng cho AJAX requests.

**Ứng dụng**: Form submission, dynamic search/filter mà không reload page.

### 3.8.2 Concurrently

**Mục đích**: Chạy nhiều command đồng thời trong Node.js environment.

**Ứng dụng**: Development script `npm run dev` chạy PHP server, queue listener, Vite dev server, Pail logs cùng một lúc.

## 3.9. Kiến trúc tổng thể

```
┌─────────────────────────────────────────────────────────┐
│                    Client (Browser)                        │
│  - Blade Template (HTML)                                   │
│  - Tailwind CSS (Styling)                                  │
│  - Tom Select (Enhanced Select)                            │
│  - Axios (AJAX)                                            │
└────────┬────────────────────────────────────────────────┘
         │
    HTTP/HTTPS
         │
┌────────▼────────────────────────────────────────────────┐
│              Laravel 12 Application Server                  │
│  ┌───────────────────────────────────────────────────┐  │
│  │  Route (web.php, admin.php, customer.php)        │  │
│  └───────────────────────────────────────────────────┘  │
│  ┌───────────────────────────────────────────────────┐  │
│  │  Middleware (auth, admin, customer guards)       │  │
│  └───────────────────────────────────────────────────┘  │
│  ┌───────────────────────────────────────────────────┐  │
│  │  Controllers (Business Logic)                    │  │
│  └───────────────────────────────────────────────────┘  │
│  ┌───────────────────────────────────────────────────┐  │
│  │  Models & Policies (Data & Authorization)        │  │
│  └───────────────────────────────────────────────────┘  │
└────────┬────────────────────────────────────────────────┘
         │
    SQL Queries
         │
┌────────▼────────────────────────────────────────────────┐
│              MySQL Database                               │
│  - users, customers, employees (Users)                   │
│  - fields, field_types, images (Field Info)              │
│  - bookings, time_slots, field_prices (Booking)          │
│  - bills, payment_methods (Payment)                      │
└──────────────────────────────────────────────────────────┘

Build Pipeline (Vite):
  - Input: resources/css/app.css, resources/js/app.js
  - Process: Minify, tree-shake, compile Tailwind CSS
  - Output: public/build/app.*.js, public/build/app.*.css
```

## 3.10. Tóm tắt và kết luận

Dự án sử dụng các công nghệ hiện đại, phù hợp với yêu cầu của hệ thống quản lý đặt sân bóng. Laravel cung cấp foundation mạnh mẽ cho backend logic, database schema được tối ưu với index để performance, Blade + Tailwind CSS + Tom Select tạo giao diện user-friendly, và Vite tối ưu asset bundle cho hiệu suất tốt. Các lựa chọn công nghệ được thực hiện với cân nhắc giữa độ phức tạp, hiệu suất, và khả năng bảo trì lâu dài.

---

## Tài liệu tham khảo

1. Laravel Documentation. (2024). "Laravel 12 Documentation". https://laravel.com/docs/12.x
2. MySQL Documentation. (2024). "MySQL 8.0 Reference Manual". https://dev.mysql.com/doc/
3. Tailwind CSS. (2024). "Tailwind CSS Documentation". https://tailwindcss.com/docs
4. Vite. (2024). "Vite Next Generation Frontend Tooling". https://vitejs.dev/
5. Tom Select. (2024). "Tom Select - Hybrid select/input plugin". https://tom-select.js.org/
6. PHPUnit. (2024). "PHPUnit Manual". https://phpunit.de/manual/current/en/
7. MDN Web Docs. (2024). "Axios - Promise based HTTP client". https://developer.mozilla.org/en-US/
