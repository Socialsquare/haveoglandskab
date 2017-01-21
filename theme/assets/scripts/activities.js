(function($) {
    var calendar = $('#calendar');
    var minDate = moment('2017-08-30');
    var maxDate = moment('2017-09-01');

    var events = [
            {
                title  : 'Introduktion til plæneklipning',
                start  : '2017-08-30T12:30:00',
                allDay : false
            },
            {
                title  : 'Sådan undgår du orme i æblerne',
                start  : '2017-09-01T12:30:00',
                end    : '2017-09-01T13:30:00'
            },
            {
                title  : 'event3',
                start  : '2017-08-T12:30:00',
                allDay : false // will make the time show
            }
        ];
    // page is now ready, initialize the calendar...
    calendar.fullCalendar({
        defaultDate: moment('2017-08-30'),
        locale: 'da',
        aspectRatio: 2,
        changeView: 'listDay',
        events: events,

        viewRender: function(view,element) {
            console.log(view.start,view.end);
        }
    });
    calendar.fullCalendar('changeView', 'listDay');
})(jQuery);