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

$(document).on('click', '.subjects', function(event){    
    if(event.target.id != null){
        var itemBox = $("#"+ event.target.id);
        //check other checkboxes
        if($(itemBox).is(":checked") && event.target.id == 'all'){           
            $(".chk-sub").prop("checked", true);
        }
        if(!$(itemBox).is(":checked") && event.target.id == 'all'){           
            $(".chk-sub").prop("checked", false);
        }
    }
});
//if yearly is checked display all terms
$(document).on('change', '#yearly', function(event){
    
});