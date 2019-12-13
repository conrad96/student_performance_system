$(document).on('change', "#sample", function(){
    var newSample = $("#sample").val();
    var getBaseURL = $("#getBaseURL").val();

    $("#resultsCanvas").html("<center style='padding-top: 8%;'><img src='"+getBaseURL+"assets/img/loading.gif' style='width: 10%;'/></center>");
    //hide results canvas for 5sec
    var delay = 5000;
    setTimeout(function(){
        $("#resultsCanvas").show();
    }, delay);
});
