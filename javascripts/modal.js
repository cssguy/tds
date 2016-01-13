$(document).ready(function(){
    $(".alert-success").wrap("<div class='tds_modal'></div>");

    $(".ok").click(function(){
      $(".tds_modal").hide();
      $(".alert-success").hide();
	  $(location).attr('href',"index.php");
    });
  });