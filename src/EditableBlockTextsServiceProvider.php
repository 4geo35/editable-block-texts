<?php

namespace GIS\EditableBlockTexts;

use GIS\EditableBlockTexts\Models\BlockText;
use GIS\EditableBlockTexts\Observers\BlockTextObserver;
use Illuminate\Support\ServiceProvider;

class EditableBlockTextsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");
        $this->mergeConfigFrom(__DIR__ . "/config/editable-block-texts.php", "editable-block-texts");
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "ebtxts");

        $this->observeModels();
    }

    protected function observeModels(): void
    {
        $modelClass = config("editable-block-texts.customBlockTextModel") ?? BlockText::class;
        $observerClass = config("editable-block-texts.customBlockTextModelObserver") ?? BlockTextObserver::class;
        $modelClass::observe($observerClass);
    }
}
