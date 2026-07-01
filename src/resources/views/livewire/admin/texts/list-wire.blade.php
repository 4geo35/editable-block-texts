<div class="{{ $useCardCover ? 'card' : 'mt-indent' }}">
    @if (!$useCardCover)
        <div class="border-t border-secondary"></div>
    @endif
    <div class="card-header space-y-indent-half">
        <div class="flex items-center justify-between">
            <div class="text-lg font-semibold mr-indent-half">Текстовые блоки</div>
            <button type="button" class="btn {{ $useCardCover ? 'btn-primary' : 'btn-outline-primary' }} px-btn-x-ico lg:px-btn-x"
                    wire:loading.attr="disabled"
                    wire:click="showCreate">
                <x-tt::ico.circle-plus />
                <span class="hidden lg:inline-block pl-btn-ico-text">Добавить текст</span>
            </button>
        </div>
        <x-tt::notifications.error prefix="block-texts-{{ $blockItem->id }}-" />
        <x-tt::notifications.success prefix="block-texts-{{ $blockItem->id }}-" />
    </div>
    @include("ebtxts::admin.includes.items")
    @include("ebtxts::admin.includes.modals")
</div>
