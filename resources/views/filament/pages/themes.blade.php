<x-filament::page>
    @if(count($data))
    <div class="grid grid-cols-3 gap-3">
        @foreach ($data as $theme)
        <x-filament::card description="welcome">
            <x-filament::card.heading>
                @php
                    $themeName = $theme['info']->{app()->getLocale()} ?? __($theme['info']->name ?? '');
                    $themeDescriptionLocale = 'description_'.app()->getLocale();
                    $themeDescription = $theme['info']->{$themeDescriptionLocale} ?? __($theme['info']->description ?? '');
                @endphp
                {{ $themeName }}
                <p class="text-sm text-gray-400">{{ $themeDescription }}</p>
            </x-filament::card.heading>
            <x-filament::hr />
            <img src="{{url($theme['info']->image)}}" />
            <x-filament::hr />
            <div class="flex justify-start space-x-4">
                @if(setting('theme_name') !== $theme['info']->aliases)
                    <a href="{{url('admin/themes/active?theme=themes.' . $theme['info']->aliases . '&name=' . $theme['info']->aliases)}}"
                       class="inline-flex items-center justify-center font-medium tracking-tight transition rounded-lg focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 px-4 text-white shadow focus:ring-white">
                        {{__('Active')}}
                    </a>
                @else
                    <a href="{{url('/')}}" target="_blank"
                       class="inline-flex items-center justify-center font-medium tracking-tight transition rounded-lg focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 px-4 text-white shadow focus:ring-white">
                        {{__('Preview')}}
                    </a>
                @endif
                <form method="POST" action="{{route('admin.themes.destroy', $theme['info']->aliases)}}">
                    @csrf
                    @method('POST')
                    <button type="submit" href="{{url('/')}}" target="_blank"
                       class="inline-flex items-center justify-center font-medium tracking-tight transition rounded-lg focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 h-9 px-4 text-white shadow focus:ring-white">
                        {{__('Delete')}}
                    </button>
                </form>
            </div>
        </x-filament::card>
        @endforeach

    </div>
    @else
        <x-filament::card>
            <div class="flex justify-center">
                <x-heroicon-o-x-circle class="w-16 h-16 text-danger-500 text-center"/>
            </div>
            <p class="text-gray-500 text-center">
                {{__('Sorry No themes found please create new')}}
            </p>
        </x-filament::card>
    @endif

</x-filament::page>
