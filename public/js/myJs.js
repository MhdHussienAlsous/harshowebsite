function setTypeItem($type) {
  if ($type.value == 1) {
    $(".url").hide();
    $(".image").show();
  } else if ($type.value == 2) {
    $(".url").show();
    $(".image").hide();
  } else {
    $(".url").hide();
    $(".image").hide();
  }
}

// this code to show / hide permissions div HTML
$(".roles").change(function() {
  var role = $("#roles :selected").text();
  var admin = "Admin";

  if (admin.localeCompare(role) == 0) {
    $("#permissions").attr("style", "display: none;");
  } else {
    $("#permissions").removeAttr("style");
  }
});

function setTypeDivin(element) {
  if (element.value == 1) {
    $("#code").show();
    $("#description").show();
    $("#note").hide();
  } else {
    $("#code").hide();
    $("#description").hide();
    $("#note").show();
  }
}
