# TODO: Implement Login Form for Admin and Member Roles

- [x] Create LoginController.php to handle login logic (authenticate, redirect based on role)
- [x] Create resources/views/login.blade.php with login form (username, password)
- [x] Update routes/web.php to add GET /login, POST /login, POST /logout routes
- [x] Update resources/views/beranda.blade.php navbar to show login/logout links based on auth status
- [x] Register middleware in bootstrap/app.php
- [x] Apply admin middleware to admin routes
- [x] Fix middleware logic and use Session::flash for redirects
- [x] Add logout button to admin dashboard
- [x] Test login functionality with admin (admin/password123) and member (member/member123) credentials
- [x] Fix User model methods (isAdmin, isMember)
- [x] Fix database migrations and seeder
- [x] Fix middleware to use model methods
