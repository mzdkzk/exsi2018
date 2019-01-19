$(document).ready(function() {
  $.get('/json.php', function(data) {
    $('#calendar').fullCalendar({
      events: JSON.parse(data).result
    })
  })
})
