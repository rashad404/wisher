require('./bootstrap'); // This loads any default Laravel setup, like Axios for HTTP requests.

import { Calendar } from '@fullcalendar/core'; // Import the core FullCalendar class
import dayGridPlugin from '@fullcalendar/daygrid'; // Import the day grid view plugin (monthly calendar view)
import interactionPlugin from '@fullcalendar/interaction'; // Import interaction plugin (for drag-and-drop, etc.)

// Ensure that the DOM is fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin], // Attach plugins to FullCalendar
        initialView: 'dayGridMonth', // Set the initial view to the monthly grid
        events: calendarEvents, // Use the events array defined in your Blade template
    });
    calendar.render(); // Render the calendar on the page
});
