var jdata
$(document).ready(function() {
  $.get('/json.php', function(data) {
    jdata = data
    $('#calendar').fullCalendar({
      events: JSON.parse(data).result
    })
  })
})
