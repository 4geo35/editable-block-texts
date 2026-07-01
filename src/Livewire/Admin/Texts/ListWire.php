<?php

namespace GIS\EditableBlockTexts\Livewire\Admin\Texts;

use GIS\EditableBlockTexts\Interfaces\BlockTextModelInterface;
use GIS\EditableBlockTexts\Interfaces\ShouldTextsInterface;
use GIS\EditableBlockTexts\Models\BlockText;
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

    public function mount(): void
    {
        $this->checkUseMarkdown();
    }

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
        $this->checkUseMarkdown();
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

    public function showEdit(int $modelId): void
    {
        $this->resetFields();
        $this->txtId = $modelId;
        $model = $this->findModel();
        if (! $model) { return; }

        $this->title = (string) $model->title;
        $this->description = (string) $model->description;
        $this->checkUseMarkdown();

        $this->displayData = true;
    }

    public function update(): void
    {
        $model = $this->findModel();
        if (! $model) { return; }
        $this->validate();

        $model->update([
            "title" => $this->title,
            "description" => $this->description,
            "use_markdown" => $this->useMarkdown ? now() : null,
        ]);

        session()->flash("block-texts-{$this->blockItem->id}-success", "Текст успешно обновлен");
        $this->closeData();
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function showDelete(int $modelId): void
    {
        $this->resetFields();
        $this->txtId = $modelId;
        $model = $this->findModel();
        if (! $model) { return; }
        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $model = $this->findModel();
        if (! $model) { return; }

        try {
            $model->delete();
        } catch (\Exception $exception) {
            session()->flash("block-texts-{$this->blockItem->id}-error", "Ошибка при удалении текста");
            $this->closeDelete();
            return;
        }

        session()->flash("block-texts-{$this->blockItem->id}-success", "Тест успешно удален");
        $this->closeDelete();
    }

    public function moveUp(int $txtId): void
    {
        $this->txtId = $txtId;
        $model = $this->findModel();
        if (! $model) { return; }

        $prev = $this->blockItem->texts()
            ->where("priority", "<", $model->priority)
            ->orderBy("priority", "desc")
            ->first();

        if ($prev) { $this->switchPriority($model, $prev); }
    }

    public function moveDown(int $txtId): void
    {
        $this->txtId = $txtId;
        $model = $this->findModel();
        if (! $model) { return; }

        $prev = $this->blockItem->texts()
            ->where("priority", ">", $model->priority)
            ->orderBy("priority", "asc")
            ->first();

        if ($prev) { $this->switchPriority($model, $prev); }
    }

    protected function switchPriority(BlockTextModelInterface $item, BlockTextModelInterface $target): void
    {
        $buff = $target->priority;
        $target->priority = $item->priority;
        $target->save();

        $item->priority = $buff;
        $item->save();
    }

    protected function resetFields(): void
    {
        $this->reset("title", "description", "txtId");
    }

    protected function findModel(): ?BlockTextModelInterface
    {
        $modelClass = config("editable-block-texts.customBlockTextModel") ?? BlockText::class;
        $modelObject = $modelClass::query()->find($this->txtId);
        if (! $modelObject) {
            session()->flash("block-texts-{$this->blockItem->id}-error", "Текст не найден");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $modelObject;
    }

    protected function checkUseMarkdown(): void
    {
        $this->useMarkdown = $this->textConstraint <= 0;
    }
}
