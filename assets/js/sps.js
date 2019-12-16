$(document).on('change', "#sample", function(){
    var newSample = $("#sample").val();
    var getBaseURL = $("#getBaseURL").val();
    
    //hide results canvas for 5sec
    $.ajax({
        type: "POST",
        url: getBaseURL + 'index.php/User/filter',
        data: {'field': 'BD.sample_id', 'value': newSample},
        success: function(data){
            $("#resultsCanvas").html(data);
        },
        beforeSend: function(){
            $("#resultsCanvas").html("<center style='padding-top: 8%;'><img src='"+getBaseURL+"assets/img/loading.gif' style='width: 10%;'/></center>");
        }
    });
});

$(document).on('change', '#term', function(){
    var newTerm = $("#term").val();
    var examValue = $("#exam").val();
    var sampleId = $("#sample").val();

    var getBaseURL = $("#getBaseURL").val();
    $.ajax({
        type: "POST",
        url: getBaseURL + 'index.php/User/filter',
        data: {'field': 'BD.'+newTerm+'_'+examValue, 'value': newTerm, 'sampleId': sampleId},
        success: function(data){
            $("#resultsCanvas").html(data);
        },
        beforeSend: function(){
            $("#resultsCanvas").html("<center style='padding-top: 8%;'><img src='"+getBaseURL+"assets/img/loading.gif' style='width: 10%;'/></center>");
        }
    });
});
