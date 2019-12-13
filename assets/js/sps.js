$(document).on('change', "#sample", function(){
    var newSample = $("#sample").val();
    var getBaseURL = $("#getBaseURL").val();

    $("#resultsCanvas").html("<center style='padding-top: 8%;'><img src='"+getBaseURL+"assets/img/loading.gif' style='width: 10%;'/></center>");
    //hide results canvas for 5sec
    var delay = 5000;
    setTimeout(function(){
        $("#resultsCanvas").show();
        //
        $.ajax({
            type: "POST",
            url: getBaseURL + 'index.php/User/filter',
            data: {'field': 'BD.sample_id', 'value': newSample},
            success: function(data){
                $("#resultsCanvas").html(data);
            }
        });
    }, delay);
});
