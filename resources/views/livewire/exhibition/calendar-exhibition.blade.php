<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.calendar_of', ['name' => __('app.exhibitions')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 px-6">
            <div id="calendar-container" class="w-full" wire:ignore>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="/js/@fullcalendar/main.global.min.js"></script>
<script src="/js/@fullcalendar/locales-all.global.min.js"></script>
<script src="/js/@fullcalendar/daygrid/main.global.min.js"></script>
<script src="/js/@fullcalendar/list/main.global.min.js"></script>
<script src="/js/@fullcalendar/timegrid/main.global.min.js"></script>
<script>
document.addEventListener('livewire:load', function () {
    const Calendar = FullCalendar.Calendar;
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: '{{ config('app.locale') }}',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: '{{ route('api.exhibition.all') }}',
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.link) {
                window.open(info.event.link);
            }
        },
        dayMaxEventRows: true,
        views: {
            timeGrid: {
                dayMaxEventRows: 4
            }
        }
    });
    calendar.render();
});
</script>
@endpush
