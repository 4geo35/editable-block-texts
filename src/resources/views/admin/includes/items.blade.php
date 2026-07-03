<div class="card-body px-0 space-y-indent-half">
    @foreach($texts as $item)
        <div class="border-b border-secondary last-of-type:border-b-0">
            <div class="flex items-start justify-start p-indent-sm space-x-indent">
                <div class="space-y-indent-half">
                    <div class="flex justify-start">
                        <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-e-none"
                                @if ($loop->last) disabled @else wire:loading.attr="disabled" @endif
                                wire:click="moveDown({{ $item->id }})">
                            <x-tt::ico.line-arrow-bottom width="18" height="18" />
                        </button>
                        <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                                @if ($loop->first) disabled @else wire:loading.attr="disabled" @endif
                                wire:click="moveUp({{ $item->id }})">
                            <x-tt::ico.line-arrow-top width="18" height="18" />
                        </button>
                    </div>

                    <div class="flex justify-start">
                        <button type="button" class="btn btn-sm btn-dark px-btn-x-ico rounded-e-none"
                                wire:loading.attr="disabled"
                                wire:click="showEdit({{ $item->id }})">
                            <x-tt::ico.edit/>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger px-btn-x-ico rounded-s-none"
                                wire:loading.attr="disabled"
                                wire:click="showDelete({{ $item->id }})">
                            <x-tt::ico.trash/>
                        </button>
                    </div>
                </div>
                <div class="space-y-indent-half flex-auto">
                    @if ($item->title)
                        <div class="font-semibold text-lg">{{ $item->title }}</div>
                    @endif
                    @if ($item->description)
                        <div class="prose max-w-none">
                            @if ($item->use_markdown)
                                {!! $item->markdown !!}
                            @else
                                {{ $item->description }}
                            @endif
                        </div>
                    @endif

                    <livewire:ebtns-btn-list :blockItem="$item" wire:key="text-block-{{ $item->modelHash }}{{ $item->id }}" :useCardCover="true" />
                </div>
            </div>
        </div>
    @endforeach
</div>
