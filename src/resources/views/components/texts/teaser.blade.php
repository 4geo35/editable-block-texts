@props(["text"])
<div>
    @if ($text->title)
        <div class="text-h3-mobile sm:text-h3 font-semibold mb-indent-half sm:mb-indent">
            {{ $text->title }}
        </div>
    @endif
    @if ($text->use_markdown)
        <div class="prose max-w-none prose-p:leading-6">
            {!! $text->markdown !!}
        </div>
    @else
        <div class="leading-6">{{ $text->description }}</div>
    @endif
    @includeIf("ebtns::web.render-buttons", ["blockItem" => $text])
</div>
