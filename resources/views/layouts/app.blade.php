<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <!-- Styles -->
   
   @if(env('APP_ENV') === 'testing' && file_exists(public_path('mix-manifest.json')))
        <link href="{{ mix('vendor/avored/css/app.css') }}" rel="stylesheet">
    @else
        {!! Asset::renderCSS() !!}
    @endif

    @push('styles')

</head>

<body>
    @include('avored::partials.notification')
    <div id="app">
        <avored-alert></avored-alert>
        <avored-confirm></avored-confirm>
        <avored-layout inline-template>
            
            <div class="flex items-start">
                <div v-bind:class="sidebar ? 'w-16 z-0 transition sidebar-collapsed duration-500' : 'w-64'">
                    @include('avored::partials.sidebar')
                </div>
                <div class="w-full">
                    <div class="w-full">
                    @include('avored::partials.header')
                    @include('avored::partials.breadcrumb')

                    <h1 class="mx-4 px-4 my-3">
                        @yield('page_title')
                    </h1>
                    <div class="rounded p-5 mx-3 my-3 bg-white">
                        <router-view></router-view>
                        @yield('content')
                    </div>

                    @include('avored::partials.footer')
                    </div>
                </div>
            </div>
        </avored-layout>
    </div>
    @if(env('APP_ENV') === 'testing' && file_exists(public_path('mix-manifest.json')))
        <script src="{{ mix('/vendor/avored/js/avored.js') }}"></script>
        @stack('scripts')
        <script src="{{ mix('/vendor/avored/js/app.js') }}"></script>
    @else
        <script src="{{ route('admin.script', 'avored.avored.js') }}"></script>
        @stack('scripts')
        <script src="{{ route('admin.script', 'avored.app.js') }}"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js"></script>
    @stack('bottom-scripts')
    <script>
        function avoredDropdownHandler(value, options) {
            return {
                dropdownIsOpen: false,
                fieldValue: value,
                options: JSON.parse(options),
                selectedLabel: '',
                dropdownInit() {
                    this.selectedLabel = this.options[this.fieldValue]
                },
                optionClicked(val, $dispatch) {
                    this.dropdownIsOpen = false
                    this.fieldValue = val
                    this.selectedLabel = this.options[val]
                    console.log($dispatch)
                    $dispatch('change', {val: val})
                },
                isCheckboxVisible(val) {
                    return (this.fieldValue == val) ? 'text-primary' : 'hidden'
                }
            }
        }
        function avoredEditor() {
            return {
                value: null,
                easymde: null,
                widgetClick() {
                    alert('fire modal show event')
                },
                initEditor(initialValue) {
                    var app = this
                    this.value = initialValue
                    this.easymde = new EasyMDE({
                        element: document.getElementById('content'),
                        initialValue : initialValue,
                        toolbar: [
                            'bold',
                            'italic',
                            'heading', '|', 'quote', 'unordered-list', 'ordered-list',  '|',  'image', 'link', '|', 'table', 'preview', '|', 'side-by-side', 
                            {
                                name: 'custom',
                                action: app.widgetClick,
                                className: 'fa fa-star',
                                title: 'Widget'
                            }
                        ]
                    });
                    this.easymde.codemirror.on("change", function() {
                        app.value = app.easymde.value()
                    });
                }
            }
        }

        function avoredToggle() {
            return {
                value: null,
                checkedValue: null,
                uncheckedValue: null,
                initToggle(checkedValue, uncheckedValue, value) {
                    this.checkedValue = checkedValue
                    this.uncheckedValue = uncheckedValue
                    this.value = value
                },
                toggleChangeEvent (e) {
                    if (e.target.checked) {
                        this.value = this.checkedValue
                    } else {
                        this.value = this.uncheckedValue
                    }
                }
            }
        }
    </script>
</body>

</html>
