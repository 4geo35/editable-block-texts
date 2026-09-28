### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/editable-block-texts/src/resources/views/livewire/admin/**/*.blade.php",
    "./vendor/4geo35/editable-block-texts/src/resources/views/admin/**/*.blade.php",
    "./vendor/4geo35/editable-block-texts/src/resources/views/components/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/editable-block-texts/src/resources/views/web/**/*.blade.php",

Запустить миграции для создания таблиц `php artisan migrate`

#### Views

Сокращение для представлений: `ebtxts`
Компонент для вывода текста: `<x-ebtxts::texts.teaser :$text />`

#### Livewire Components

Admin

- `ebtxts-text-list`: список текстов, относящихся к модели `block-item`; `use-card-cover` - отображать с классом `card` или без.

#### Traits

- `ShouldTexts` - набор методов, необходимых для управления текстами у модели.

#### Interfaces

- `ShouldTextsInterface` - интерфейс, который необходим для модели с текстами.
