<?php

namespace GIS\EditableBlockTexts\Models;

use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BlockText extends Model
{
    use ShouldMarkdown;

    protected $fillable = [
        "text",
        "use_markdown",
    ];

    public function textable(): MorphTo
    {
        return $this->morphTo();
    }
}
