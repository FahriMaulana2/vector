# STRUKTUR FOLDER PROYEK OMH

```
OMH/
├── .editorconfig
├── .gitattributes
├── .gitignore
├── .npmrc
├── AGENTS.md
├── artisan
├── boost.json
├── composer.json
├── composer.lock
├── package-lock.json
├── package.json
├── phpstan.neon
├── phpunit.xml
├── pint.json
├── PLAN.md
├── STRUKTUR_FOLDER.md
├── TODO.md
├── vite.config.js
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Controller.php
│   │
│   ├── Livewire/
│   │   ├── About.php
│   │   ├── Contact.php
│   │   ├── Footer.php
│   │   ├── Hero.php
│   │   ├── Home.php
│   │   ├── Navbar.php
│   │   ├── Portfolio.php
│   │   ├── Products.php
│   │   ├── Services.php
│   │   ├── Testimonials.php
│   │   ├── WhyChooseUs.php
│   │   ├── Workflow.php
│   │   │
│   │   └── Admin/
│   │       ├── Dashboard.php
│   │       └── Auth/
│   │           └── Login.php
│   │
│   ├── Models/
│   │   ├── AboutSection.php
│   │   ├── ContactMessage.php
│   │   ├── Faq.php
│   │   ├── HeroSection.php
│   │   ├── HeroStatistic.php
│   │   ├── Order.php
│   │   ├── OrderStatusHistory.php
│   │   ├── Portfolio.php
│   │   ├── PortfolioCategory.php
│   │   ├── PortfolioImage.php
│   │   ├── Product.php
│   │   ├── ProductCategory.php
│   │   ├── ProductImage.php
│   │   ├── Service.php
│   │   ├── Setting.php
│   │   ├── Testimonial.php
│   │   ├── User.php
│   │   ├── WhyChooseUs.php
│   │   └── WorkflowStep.php
│   │
│   └── Providers/
│       └── AppServiceProvider.php
│
├── bootstrap/
│   ├── app.php
│   ├── providers.php
│   └── cache/
│       └── .gitignore
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── livewire.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
│
├── database/
│   ├── .gitignore
│   ├── factories/
│   │   └── UserFactory.php
│   │
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_07_27_022620_create_product_categories_table.php
│   │   ├── 2026_07_27_022621_create_portfolio_categories_table.php
│   │   ├── 2026_07_27_022622_create_products_table.php
│   │   ├── 2026_07_27_022623_create_product_images_table.php
│   │   ├── 2026_07_27_022624_create_services_table.php
│   │   ├── 2026_07_27_022625_create_hero_sections_table.php
│   │   ├── 2026_07_27_022626_create_hero_statistics_table.php
│   │   ├── 2026_07_27_022627_create_about_sections_table.php
│   │   ├── 2026_07_27_022628_create_why_choose_us_table.php
│   │   ├── 2026_07_27_022629_create_workflow_steps_table.php
│   │   ├── 2026_07_27_022630_create_portfolios_table.php
│   │   ├── 2026_07_27_022631_create_portfolio_images_table.php
│   │   ├── 2026_07_27_022632_create_testimonials_table.php
│   │   ├── 2026_07_27_022633_create_faqs_table.php
│   │   ├── 2026_07_27_022634_create_orders_table.php
│   │   ├── 2026_07_27_022635_create_order_status_histories_table.php
│   │   ├── 2026_07_27_022636_create_contact_messages_table.php
│   │   └── 2026_07_27_022637_create_settings_table.php
│   │
│   └── seeders/
│       ├── AboutSectionSeeder.php
│       ├── DatabaseSeeder.php
│       ├── FaqSeeder.php
│       ├── HeroSectionSeeder.php
│       ├── HeroStatisticSeeder.php
│       ├── PortfolioCategorySeeder.php
│       ├── PortfolioImageSeeder.php
│       ├── PortfolioSeeder.php
│       ├── ProductCategorySeeder.php
│       ├── ProductImageSeeder.php
│       ├── ProductSeeder.php
│       ├── ServiceSeeder.php
│       ├── SettingSeeder.php
│       ├── TestimonialSeeder.php
│       ├── WhyChooseUsSeeder.php
│       └── WorkflowStepSeeder.php
│
├── public/
│   ├── .htaccess
│   ├── apple-touch-icon.png
│   ├── favicon.ico
│   ├── favicon.svg
│   ├── index.php
│   ├── robots.txt
│   └── build/
│       ├── fonts-manifest.json
│       ├── manifest.json
│       └── assets/
│           ├── app-5kR0fG2Q.css
│           ├── app-Cg3nMGUZ.js
│           ├── app-PTugdkvS.css
│           ├── fonts-C9MNnjVw.css
│           ├── instrument-sans-400-normal-D1W7dsQl.woff
│           ├── instrument-sans-400-normal-DRC__1Mx.woff2
│           ├── instrument-sans-500-normal-Dk9ku72i.woff2
│           ├── instrument-sans-500-normal-Z6ESRlEs.woff
│           ├── instrument-sans-600-normal-B7fBEWYG.woff2
│           └── instrument-sans-600-normal-B9e8oLYv.woff
│
├── resources/
│   ├── css/
│   │   └── app.css
│   │
│   ├── js/
│   │   └── app.js
│   │
│   └── views/
│       ├── welcome.blade.php
│       │
│       ├── components/
│       │   ├── admin/
│       │   │   ├── sidebar.blade.php
│       │   │   ├── stat-card.blade.php
│       │   │   └── topbar.blade.php
│       │   │
│       │   └── layouts/
│       │       ├── admin.blade.php
│       │       ├── app.blade.php
│       │       └── auth.blade.php
│       │
│       ├── layouts/
│       │   └── app.blade.php
│       │
│       └── livewire/
│           ├── about.blade.php
│           ├── contact.blade.php
│           ├── footer.blade.php
│           ├── hero.blade.php
│           ├── home.blade.php
│           ├── navbar.blade.php
│           ├── portfolio.blade.php
│           ├── products.blade.php
│           ├── services.blade.php
│           ├── testimonials.blade.php
│           ├── why-choose-us.blade.php
│           ├── workflow.blade.php
│           │
│           ├── admin/
│           │   ├── dashboard.blade.php
│           │   └── auth/
│           │       └── login.blade.php
│
├── routes/
│   ├── console.php
│   └── web.php
│
├── storage/
│   ├── app/
│   │   └── .gitignore
│   ├── framework/
│   │   ├── cache/
│   │   │   └── .gitignore
│   │   ├── sessions/
│   │   │   └── .gitignore
│   │   ├── testing/
│   │   │   └── .gitignore
│   │   └── views/
│   │       └── .gitignore
│   └── logs/
│       └── .gitignore
│
├── tests/
│   ├── Pest.php
│   ├── TestCase.php
│   ├── Feature/
│   │   └── ExampleTest.php
│   └── Unit/
│       └── ExampleTest.php
│
├── vendor/          (folder - tidak dijabarkan isinya)
│
└── node_modules/    (folder - tidak dijabarkan isinya)
```

---

## RINGKASAN PROYEK

### 1. Framework & Versi
- **Framework**: Laravel Framework v13.x
- **PHP**: ^8.3
- **Livewire**: v4.x
- **Tailwind CSS**: v4.x
- **Vite**: v8.x
- **Pest**: v4.x (Testing)
- **Database Default**: SQLite

### 2. Daftar Semua Model (20 Models)
1. AboutSection
2. ContactMessage
3. Faq
4. HeroSection
5. HeroStatistic
6. Order
7. OrderStatusHistory
8. Portfolio
9. PortfolioCategory
10. PortfolioImage
11. Product
12. ProductCategory
13. ProductImage
14. Service
15. Setting
16. Testimonial
17. User
18. WhyChooseUs
19. WorkflowStep

### 3. Daftar Semua Migration (21 Files)
1. 0001_01_01_000000_create_users_table.php
2. 0001_01_01_000001_create_cache_table.php
3. 0001_01_01_000002_create_jobs_table.php
4. 2026_07_27_022620_create_product_categories_table.php
5. 2026_07_27_022621_create_portfolio_categories_table.php
6. 2026_07_27_022622_create_products_table.php
7. 2026_07_27_022623_create_product_images_table.php
8. 2026_07_27_022624_create_services_table.php
9. 2026_07_27_022625_create_hero_sections_table.php
10. 2026_07_27_022626_create_hero_statistics_table.php
11. 2026_07_27_022627_create_about_sections_table.php
12. 2026_07_27_022628_create_why_choose_us_table.php
13. 2026_07_27_022629_create_workflow_steps_table.php
14. 2026_07_27_022630_create_portfolios_table.php
15. 2026_07_27_022631_create_portfolio_images_table.php
16. 2026_07_27_022632_create_testimonials_table.php
17. 2026_07_27_022633_create_faqs_table.php
18. 2026_07_27_022634_create_orders_table.php
19. 2026_07_27_022635_create_order_status_histories_table.php
20. 2026_07_27_022636_create_contact_messages_table.php
21. 2026_07_27_022637_create_settings_table.php

### 4. Daftar Semua Seeder (16 Files)
1. DatabaseSeeder.php
2. HeroSectionSeeder.php
3. HeroStatisticSeeder.php
4. AboutSectionSeeder.php
5. ServiceSeeder.php
6. WhyChooseUsSeeder.php
7. WorkflowStepSeeder.php
8. TestimonialSeeder.php
9. FaqSeeder.php
10. SettingSeeder.php
11. ProductCategorySeeder.php
12. ProductSeeder.php
13. ProductImageSeeder.php
14. PortfolioCategorySeeder.php
15. PortfolioSeeder.php
16. PortfolioImageSeeder.php

### 5. Daftar Semua Livewire Component (14 Components)
1. Home.php (Frontend)
2. Navbar.php (Frontend)
3. Hero.php (Frontend)
4. About.php (Frontend)
5. Services.php (Frontend)
6. Products.php (Frontend)
7. Portfolio.php (Frontend)
8. WhyChooseUs.php (Frontend)
9. Workflow.php (Frontend)
10. Testimonials.php (Frontend)
11. Contact.php (Frontend)
12. Footer.php (Frontend)
13. Admin/Auth/Login.php (Admin)
14. Admin/Dashboard.php (Admin)

### 6. Daftar Semua Blade View
| File | Path |
|---|---|
| Welcome Page | resources/views/welcome.blade.php |
| Layout App | resources/views/components/layouts/app.blade.php |
| Layout Admin | resources/views/components/layouts/admin.blade.php |
| Layout Auth | resources/views/components/layouts/auth.blade.php |
| Layout (lama) | resources/views/layouts/app.blade.php |
| Navbar | resources/views/livewire/navbar.blade.php |
| Hero | resources/views/livewire/hero.blade.php |
| About | resources/views/livewire/about.blade.php |
| Services | resources/views/livewire/services.blade.php |
| Products | resources/views/livewire/products.blade.php |
| Portfolio | resources/views/livewire/portfolio.blade.php |
| Why Choose Us | resources/views/livewire/why-choose-us.blade.php |
| Workflow | resources/views/livewire/workflow.blade.php |
| Testimonials | resources/views/livewire/testimonials.blade.php |
| Contact | resources/views/livewire/contact.blade.php |
| Footer | resources/views/livewire/footer.blade.php |
| Home | resources/views/livewire/home.blade.php |
| Dashboard Admin | resources/views/livewire/admin/dashboard.blade.php |
| Login Admin | resources/views/livewire/admin/auth/login.blade.php |
| Sidebar Admin | resources/views/components/admin/sidebar.blade.php |
| Topbar Admin | resources/views/components/admin/topbar.blade.php |
| Stat Card Admin | resources/views/components/admin/stat-card.blade.php |

### 7. Daftar Semua Route
| Method | URI | Handler | Name | Middleware |
|---|---|---|---|---|
| GET | `/` | `App\Livewire\Home` | `home` | - |
| GET | `/admin/login` | `App\Livewire\Admin\Auth\Login` | `admin.login` | guest |
| GET | `/admin` | `App\Livewire\Admin\Dashboard` | `admin.dashboard` | auth |
| POST | `/admin/logout` | Closure | `admin.logout` | auth |
| Artisan | (inspire) | Closure | - | - |

### 8. Apakah Autentikasi Sudah Ada?
**Ya, sudah ada.** Detail:
- **Login Admin**: `/admin/login` dengan Livewire component `Admin/Auth/Login.php`
- **Logout**: POST `/admin/logout`
- **Middleware**: `guest` untuk halaman login, `auth` untuk dashboard
- **Layout**: `resources/views/components/layouts/auth.blade.php`

### 9. Apakah Admin Dashboard Sudah Ada?
**Ya, sudah ada.** Detail:
- **Livewire Component**: `app/Livewire/Admin/Dashboard.php`
- **View**: `resources/views/livewire/admin/dashboard.blade.php`
- **Layout**: `resources/views/components/layouts/admin.blade.php`
- **Komponen**: sidebar, topbar, stat-card
- **Prefix Route**: `/admin`
- **Fitur**: Belum ada CRUD, baru dashboard utama

### 10. Komponen Admin Layout
| File | Path |
|---|---|
| Layout Admin | resources/views/components/layouts/admin.blade.php |
| Layout Auth | resources/views/components/layouts/auth.blade.php |
| Sidebar | resources/views/components/admin/sidebar.blade.php |
| Topbar | resources/views/components/admin/topbar.blade.php |
| Stat Card | resources/views/components/admin/stat-card.blade.php |
