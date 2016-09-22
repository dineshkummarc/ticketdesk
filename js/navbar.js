// set active menu bar
function setActiveMenuItem(menuItem) {
  $("#dashboard").removeClass("active");
  $("#reports").removeClass("active");
  $('#tickets').removeClass("active");
  $('#system').removeClass("active");
  $(menuItem).addClass("active");
  // sub menu
  $("#subMenuMine").removeClass("active");
  $("#subMenuAll").removeClass("active");
  $("#subMenuOpen").removeClass("active");
  $("#subMenuClient").removeClass("active");
  $("#subMenuAgent").removeClass("active");
  $("#subMenuClosed").removeClass("active");

}
