<?php

namespace GIS\EditableBlockTexts\Models;

use GIS\EditableBlockButtons\Traits\ShouldButtons;
use GIS\EditableBlockTexts\Interfaces\BlockTextModelInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BlockText extends Model implements BlockTextModelInterface
{
    use ShouldMarkdown, ShouldButtons;

    protected $fillable = [
        "title",
        "description",
        "use_markdown",
    ];

    public function textable(): MorphTo
    {
        return $this->morphTo();
    }
}
