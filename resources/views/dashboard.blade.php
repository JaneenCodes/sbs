<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @auth
                    @if(auth()->user()->role == 'user')
                        <div class="p-6 text-gray-900">
                            {{ __("You're logged in!") }}
                        </div>                                   
                    @endif
                @endauth   
                @auth
                    @if(auth()->user()->role == 'admin')
                        <div class="p-6 text-gray-900">
                            <div id="calendar"></div>
                        </div>                                   
                    @endif
                @endauth   
                
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            let booking = @json($data);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: booking,
            });
        });
    </script>

</x-app-layout>
