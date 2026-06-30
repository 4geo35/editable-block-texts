<?php

namespace GIS\EditableBlockTexts\Traits;

use GIS\EditableBlockTexts\Interfaces\ShouldTextsInterface;
use GIS\EditableBlockTexts\Models\BlockText;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ShouldTexts
{
    protected static function bootShouldTexts(): void
    {
        static::deleted(function (ShouldTextsInterface $model) {
            $model->clearTexts();
        });
    }

    public function getTextModelClassAttribute(): string
    {
        return config("editable-block-texts.customBlockTextModel") ?? BlockText::class;
    }

    public function texts(): MorphMany
    {
        return $this->morphMany($this->text_model_class, "textable");
    }

    public function orderedTexts(): MorphMany
    {
        return $this->texts()->orderBy('priority');
    }

    public function clearTexts(): void
    {
        foreach ($this->texts as $text) {
            $text->delete();
        }
    }
}
