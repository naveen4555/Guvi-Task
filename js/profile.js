$(document).ready(function () {
  let userData = JSON.parse(localStorage.getItem("userdetails"));
  console.log(userData);
  if (userData) {
    console.log(userData.username);
    var username = userData.username;
    var password = userData.password;
    console.log(username);
    if (username != "" && password != "") {
      $.ajax({
        url: "http://localhost:3000/php/profile.php",
        crossDomain: true,
        type: "POST",
        data: { username: username, password: password },
        success: function (response) {
          console.log(response);
          let data = $.parseJSON(response);
          console.log(data);
          if (data.status == 200) {
            $("#user_name").text(data.name);
            $("#user_email").text("test");
            $("#user_dob").text("test");
            $("#user_contact").text("test");
          } else {
            alert(response);
          }
        },
      });
    }
  }

  $("#update").click(function () {
    $("#exampleModal").modal("toggle");
  });
  $("#close").click(function () {
    $("#exampleModal").modal("toggle");
  });
  $("#save").click(function () {
    var user_dob = $("#user_dob").val().trim();
    var user_contact = $("#user_contact").val().trim();
    var user_address = $("#user_address").val().trim();

    if (user_dob != "" && user_contact != "" && user_address != "") {
        let userData = JSON.parse(localStorage.getItem("userdetails"));
      $.ajax({
        url: "http://localhost:3000/php/profile.php",
        crossDomain: true,
        type: "POST",
        data: { user_dob: user_dob, user_contact: user_contact,user_address:user_address,username: userData.username },
        success: function (response) {
            console.log(response);
          if(response=="ok"){
            
          }
          else{
            alert(response)
          }
        },
      });
    }

    $("#exampleModal").modal("toggle");
  });
});
