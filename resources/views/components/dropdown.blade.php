@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white', 'dropdownClasses' => ''])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'none':
    case 'false':
        $alignmentClasses = '';
        break;
    case 'right':
    default:
        $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp




<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = !open">
        <!-- Add responsive classes to the trigger element -->
        {{ $trigger }}
    </div>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
      
        class="absolute z-50 mt-2 w-full sm:w-auto rounded-md shadow-lg {{ $alignmentClasses }} {{ $dropdownClasses }}"
        @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            <!-- Content of the dropdown -->
            {{ $content }}
        </div>
    </div>
</div>