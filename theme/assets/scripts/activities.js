(function($) {

  var DEFAULT_UDSTILLER = 'Have&Landskab';
  var BASE_URL = '';
  function fetchActivities(start, end, udstillerId, callback) {
    var qs = [];
    if(start) {
      qs.push('from=' + start.unix());
    }
    if(end) {
      qs.push('until=' + end.unix());
    }
    if(udstillerId) {
      qs.push('udstillerId=' + udstillerId);
    }
    $.ajax({
      url: '/wp-json/wp/v2/activity?' + qs.join('&'),
      success: function(activities) {

        // Generate an object of unique "udstillere" in the events returned
        var udstillere = {};
        activities.forEach(function(activity) {
          activity.udstillerTitle = activity.udstiller_title || DEFAULT_UDSTILLER;
          delete activity.udstiller_title;
          if(!(activity.udstillerTitle in udstillere)) {
            udstillere[activity.udstillerTitle] = {
              default: activity.udstillerTitle === DEFAULT_UDSTILLER
            };
          }
        });
        // Generate colors for every place
        var udstillerTitles = Object.keys(udstillere);
        udstillerTitles.forEach(function(udstillerTitle, placeIndex) {
          var hue = Math.round(placeIndex / udstillerTitles.length * 360);
          udstillere[udstillerTitle].color = 'hsl(' + hue + ', 80%, 50%)';
        });

        // Map the activities to events
        var events = activities.map(function(activity) {
          var event = {
            title: activity.title.rendered,
            start: activity.start * 1000,
            end: activity.end * 1000,
            url: activity.link
          };

          var udstillerTitle = activity.udstillerTitle;

          // If more than a single place is used in the activities
          if(udstillerTitles.length > 1) {
            var place = udstillere[udstillerTitle];
            event.title += ' (' + udstillerTitle + ')';
            event.color = place.color;
            event.className = place.default ? 'fc-list-item--default' : null;
          }
          // Return1
          return event;
        });
        // Return these
        callback(events);
      }
    });
  }

  $('.activity-calendar').each(function() {
    var $calendar = $(this);
    // page is now ready, initialize the calendar...
    $calendar.fullCalendar({
        defaultDate: moment('2017-08-30'),
        locale: 'da',
        header: false,
        eventColor: '#1d624b',
        defaultView: 'listWeek',
        dayNames: [
          'Søndag',
          'Mandag',
          'Tirsdag',
          'Onsdag',
          'Torsdag',
          'Fredag',
          'Lørdag'
        ],
        noEventsMessage: 'Der er ingen aktiviteter i den valgte periode',
        events: function(start, end, timezone, callback) {
          var udstillerId = $calendar.data('udstiller-id') || null;
          fetchActivities(start, end, udstillerId, callback);
        },
        eventAfterAllRender: function(view) {
          $calendar = view.el;
          var $listTable = $calendar.find('.fc-list-table');
          var newHeight = $listTable.height() + 2;
          $calendar.fullCalendar('option', 'height', newHeight);
          $calendar.find('.fc-scroller').height(newHeight);
          $calendar.height(newHeight);
        }
    });
  });
})(jQuery);
