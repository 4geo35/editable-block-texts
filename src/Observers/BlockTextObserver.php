<?php

namespace GIS\EditableBlockTexts\Observers;

use GIS\EditableBlockTexts\Interfaces\BlockTextModelInterface;
use GIS\EditableBlockTexts\Models\BlockText;

class BlockTextObserver
{
    public function creating(BlockTextModelInterface $model): void
    {
        $modelClass = config("editable-block-texts.customBlockTextModel") ?? BlockText::class;
        $priority = $modelClass::query()
            ->select("id", "priority")
            ->where("textable_id", $model->textable_id)
            ->where("textable_type", $model->textable_type)
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $model->priority = $priority + 1;
    }

    public function created(BlockTextModelInterface $model): void
    {
        $model->textable->touch();
    }

    public function updated(BlockTextModelInterface $model): void
    {
        $model->textable->touch();
    }

    public function deleted(BlockTextModelInterface $model): void
    {
        $model->textable->touch();
    }
}
