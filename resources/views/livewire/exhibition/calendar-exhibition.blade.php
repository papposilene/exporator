<div id='calendar-container' wire:ignore>
    <div id='calendar'></div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
<script>
document.addEventListener('livewire:load', function () {
    const Calendar = FullCalendar.Calendar;
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        events: JSON.parse(@this.exhibitions)
    });
    calendar.render();
});
</script>
