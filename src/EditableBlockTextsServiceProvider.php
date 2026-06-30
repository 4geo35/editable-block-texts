<?php

namespace GIS\EditableBlockTexts;

use GIS\EditableBlockTexts\Models\BlockText;
use GIS\EditableBlockTexts\Observers\BlockTextObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use GIS\EditableBlockTexts\Livewire\Admin\Texts\ListWire as AdminTextListWire;

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
        $this->addLivewireComponents();
    }

    protected function observeModels(): void
    {
        $modelClass = config("editable-block-texts.customBlockTextModel") ?? BlockText::class;
        $observerClass = config("editable-block-texts.customBlockTextModelObserver") ?? BlockTextObserver::class;
        $modelClass::observe($observerClass);
    }

    protected function addLivewireComponents(): void
    {
        $component = config("editable-block-texts.customAdminListWireComponent");
        Livewire::component(
            "ebtxts-text-list",
            $component ?? AdminTextListWire::class
        );
    }
}
