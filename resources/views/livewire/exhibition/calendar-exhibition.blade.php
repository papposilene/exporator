<div id="calendar-container" class="h-screen w-full" wire:ignore>
    <div id="calendar"></div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    let calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
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
