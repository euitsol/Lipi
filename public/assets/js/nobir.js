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
  alert("Change Happened");
});
