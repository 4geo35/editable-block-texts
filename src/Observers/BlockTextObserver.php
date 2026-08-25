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
        $this->touchTaxtable($model);
    }

    public function updated(BlockTextModelInterface $model): void
    {
        $this->touchTaxtable($model);
    }

    public function deleted(BlockTextModelInterface $model): void
    {
        $this->touchTaxtable($model);
    }

    protected function touchTaxtable(BlockTextModelInterface $model): void
    {
        if ($model->textable) {
            $model->textable->touch();
        }
    }
}
