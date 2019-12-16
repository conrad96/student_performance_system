function filterResults(){
    var newSample = $("#sample").val();
    var getBaseURL = $("#getBaseURL").val();
    var newTerm = $("#term").val();
    var examValue = $("#exam").val();
    
    //hide results canvas for 5sec
    $.ajax({
        type: "POST",
        url: getBaseURL + 'index.php/User/filter',
        data: {'field': 'BD.'+newTerm+'_'+examValue, 'examType': examValue, 'term': newTerm, 'sampleId': newSample},
        success: function(data){
            $("#resultsCanvas").html(data);
        },
        beforeSend: function(){
            $("#resultsCanvas").html("<center style='padding-top: 8%;'><img src='"+getBaseURL+"assets/img/loading.gif' style='width: 10%;'/></center>");
        }
    });
}

$(document).on('change', "#sample, #term, #exam", function(){
    filterResults();        
});
