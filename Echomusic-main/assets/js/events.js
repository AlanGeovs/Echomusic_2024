function showDetail() {
  $("#event_listContainer").hide();
  $("#event_listNextMonth").hide();
  $("#title_thisMonth").hide();
  $("#title_nextMonth").hide();
  $("#title_calendar").hide();
  $("#calendarDesc").hide();
  $("#dropdownInbox").hide();
  $("#titleInbox").hide();
  $("#event_detail_container").fadeIn(400);
  $("#event_detail").fadeIn(400);
}

function showDetailPublic() {
  $("#tablaeventosstream").hide();
  $("#event_listNextMonth").hide();
  $("#title_thisMonth").hide();
  $("#title_nextMonth").hide();
  $("#title_calendar").hide();
  $("#calendarDesc").hide();
  $("#dropdownInbox").hide();
  $("#titleInbox").hide();
  $("#detalleEventoStream").fadeIn(400);
  $("#event_detail").fadeIn(400);
}

function showList() {
  $("#event_detail_container").hide();
  $("#event_detail").fadeIn(300);
  $("#event_listContainer").fadeIn(300);
  $("#event_listNextMonth").fadeIn(300);
  $("#title_thisMonth").fadeIn(300);
  $("#title_nextMonth").fadeIn(300);
  $("#title_calendar").fadeIn(300);
  $("#calendarDesc").fadeIn(300);
  $("#dropdownInbox").fadeIn(300);
  $("#titleInbox").fadeIn(300);
}

function showListPublic() {
  $("#detalleEventoStream").hide();
  $("#event_detail").fadeIn(300);
  $("#tablaeventosstream").fadeIn(300);
  $("#event_listNextMonth").fadeIn(300);
  $("#title_thisMonth").fadeIn(300);
  $("#title_nextMonth").fadeIn(300);
  $("#title_calendar").fadeIn(300);
  $("#calendarDesc").fadeIn(300);
  $("#dropdownInbox").fadeIn(300);
  $("#titleInbox").fadeIn(300);
}

function showPublicForm() {
  $("#event_public_form").fadeIn(300);
}

function hidePublicForm() {
  $("#event_public_form").hide();
}
