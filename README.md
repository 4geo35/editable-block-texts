### Установка

Добавить `"./vendor/4geo35/editable-block-texts/src/resources/views/livewire/admin/**/*.blade.php",
        "./vendor/4geo35/editable-block-texts/src/resources/views/admin/**/*.blade.php",
        "./vendor/4geo35/editable-block-texts/src/resources/views/components/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить `"./vendor/4geo35/editable-block-texts/src/resources/views/web/**/*.blade.php",` в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`
