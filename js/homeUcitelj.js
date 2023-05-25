$(document).ready(function() {
  $("#filter-button").click(function() {
    
    refreshujCasove();
  });
});

function refreshujCasove() {
var ime = $("#ime").val();

$.ajax({
  type: "POST",
  url: "filter-casova.php",
  data: {ime: ime},
  success: function(data) {
    $("#casovi-table").html(data);
  }
});
}





