// $("#teacher_id").onChange(function () {
//   var id = $(this).val();
//   console.log(id);
// });
console.log("1");
// $("#confirm_password").on("change", function () {
//   alert("The text has been changed.");
//   console.log("12");
// });
$(document.body).on("change", "#confirm_password", function () {
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();
  if (password === confirm_password) {
    $("#err_msg").html("Confirm password don't masched with password");
  }
});
