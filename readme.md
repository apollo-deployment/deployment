## Laravel v5.5 Template

- Fixes a lot of Laravel new project issues:
  - Webpack unable to compile due to missing directories and wrong commands running
  - Major cleanup in base files
- Includes base controllers and assets:
  - Bootstrap
  - JQuery

### Installation
1) Run `cp .env.example .env`
2) Run `npm run setup` to auto run all the commands usually ran on initial setup :
- npm install --no-bin-links
- composer install
- php artisan key:generate
- php artisan migrate
- npm run dev
