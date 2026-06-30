<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить текст</x-slot>
    <x-slot name="text">Будет невозможно восстановить текст!</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">{{ $txtId ? "Редактировать" : "Добавить" }} текст</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $txtId ? 'update' : 'store' }}" class="space-y-indent-half"
              id="blockTextsDataForm-{{ $blockItem->id }}">

            <div>
                <label for="blockTextsTitle-{{ $blockItem->id }}" class="inline-block mb-2">
                    Заголовок
                </label>
                <input type="text" id="blockTextsTitle-{{ $blockItem->id }}"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                @if ($useMarkdown)
                    <label for="blockTextsDescription-{{ $blockItem->id }}" class="flex justify-start items-center mb-2">
                        Описание
                        @include("tt::admin.description-button", ["id" => "blockTextsDescription-{$blockItem->id}-Hidden"])
                    </label>
                    @include("tt::admin.description-info", ["id" => "blockTextsDescription-{$blockItem->id}-Hidden"])
                @else
                    <label for="blockTextsDescription-{{ $blockItem->id }}" class="flex justify-start items-center mb-2">
                        Описание
                    </label>
                @endif
                <textarea id="blockTextsDescription-{{ $blockItem->id }}"
                          class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="description">
                        {{ $description }}
                    </textarea>
                <x-tt::form.error name="description" />

                @if ($useMarkdown)
                    <div class="prose prose-sm mt-indent-half">
                        {!! \Illuminate\Support\Str::markdown($description) !!}
                    </div>
                @endif
            </div>


            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="blockTextsDataForm-{{ $blockItem->id }}" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    {{ $txtId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
