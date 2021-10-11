<div id="calendar-container" class="w-full" wire:ignore>
    <div id="calendar"></div>
</div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
<script>
document.addEventListener('livewire:load', function () {
    const Calendar = FullCalendar.Calendar;
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        //plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
        initialView: 'dayGridMonth',
        locale: "{{ config('app.locale') }}",
        events: JSON.parse(@this.exhibitions),
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        }
    });
    calendar.render();
});
</script>
@endpush
