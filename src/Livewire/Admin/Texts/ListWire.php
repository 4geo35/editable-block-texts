<?php

namespace GIS\EditableBlockTexts\Livewire\Admin\Texts;

use GIS\EditableBlockTexts\Interfaces\ShouldTextsInterface;
use Illuminate\View\View;
use Livewire\Component;

class ListWire extends Component
{
    public ShouldTextsInterface $blockItem;
    public bool $useMarkdown = false;
    public bool $useCardCover = false;

    public int $textConstraint = 400;

    public bool $displayData = false;

    public bool $displayDelete = false;

    public int|null $txtId = null;

    public string $title = "";
    public string $description = "";

    public function rules(): array
    {
        $rules = [
            "title" => ["nullable", "string", "max:255"],
        ];
        if (! $this->useMarkdown) {
            $rules["description"] = ["nullable", "string", "max:{$this->textConstraint}"];
        }
        return $rules;
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "description" => "Описание"
        ];
    }

    public function render(): View
    {
        $texts = $this->blockItem->orderedTexts;
        debugbar()->info($texts);
        return view("ebtxts::livewire.admin.texts.list-wire", compact("texts"));
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showCreate(): void
    {
        $this->resetFields();
        $this->displayData = true;
    }

    public function store(): void
    {
        $this->validate();

        $this->blockItem->texts()->create([
            "title" => $this->title,
            "description" => $this->description,
            "use_markdown" => $this->useMarkdown ? now() : null,
        ]);

        session()->flash("block-texts-{$this->blockItem->id}-success", "Текст успешно добавлен");
        $this->closeData();
    }

    protected function resetFields(): void
    {
        $this->reset("title", "description", "txtId");
    }

}
