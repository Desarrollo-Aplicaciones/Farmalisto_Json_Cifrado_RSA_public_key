$(document).ready(function(){

  $("#process-javascript").click(function () {
    var crypt = new JSEncrypt();
    crypt.setPublicKey(public_key);
    var json_data = $("#json-data").val();
    var encrypted = crypt.encrypt(json_data);
    $("#encrypted-data").val(encrypted);
  });
});