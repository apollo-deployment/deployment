## Laravel v5.5 Template

- Fixes a lot of Laravel new project issues:
  - Webpack unable to compile due to missing directories and wrong commands running
  - Major cleanup in base files
- Includes base controllers and assets:
  - Font awesome
  - Bootstrap
  - JQuery

### Notes
-----
Run `npm run setup` to auto run all the commands usually ran on initial setup :
- npm install --no-bin-links
- composer install
- php artisan key:generate
- php artisan migrate
- npm run dev
