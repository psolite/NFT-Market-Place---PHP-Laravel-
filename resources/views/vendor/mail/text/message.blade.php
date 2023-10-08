<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            <img style="max-height: 50px; width: auto;" src="{{ URL::asset('images/' . $settingsc->logo) }}" alt="{{ $settingsc->appname }}">
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            {{ $settingsc->mailfooter }}
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
