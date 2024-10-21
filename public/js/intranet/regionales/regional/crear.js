$(document).ready(function () {
    $("#estado").click(function () {
        var check = $(this).val();
        if ($(this).is(':checked')){
            $(this).val(1);
            $('#labelCheck').html('Regional Activa')
          }
          else {
            $(this).val(0);
            $('#labelCheck').html('Regional Inactiva')
          }
    });
});
