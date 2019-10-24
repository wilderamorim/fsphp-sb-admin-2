// Required fields
// $(":input[required]:visible").parent().find("label").addClass("required");
// $("input,textarea,select").filter("[required]:visible").parent().find("label").addClass("required");
$("input:not(:checkbox),textarea,select").filter("[required]:visible").parent().find("label").addClass("required");