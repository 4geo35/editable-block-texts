<?php

namespace GIS\EditableBlockTexts\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ShouldTextsInterface
{
    public function texts(): MorphMany;
    public function orderedTexts(): MorphMany;
    public function clearTexts(): void;
}
