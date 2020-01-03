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
    var isYearlyChecked = $("#yearly").is(":checked");
    var getBaseURL = $("#getBaseURL").val();
    var subjects = new Array();
    var terms = new Array();  
    var studentId = $("#student_id").val();
    var sampleId = $("#sample_id").val();

    //push filter variables
    $(".chk-sub").each(function(index, element){           
        if($(this).is(":checked")){
            var checkedSubject = $(this).attr("value");
            if(checkedSubject != 'all') subjects.push(checkedSubject);
        }
    });
    $(".termSelected").each(function(index, element){
        if($(this).is(":checked")){
            var checkedTerm = $(this).attr("id");
            terms.push(checkedTerm);
        }
    });

    if(isYearlyChecked){
        //by default check all subjects
        $(".chk-sub").prop("checked", true);
        
        //hide exam row
        $("#examTypeRow").hide();
        $("#terms").hide();
                
        //load result set 
        $.ajax({
            type: "post",
            url: getBaseURL + 'index.php/User/filter_student_results',
            data: {type: 'yearly', subjects: subjects, terms: terms, student_id: studentId, sample_id: sampleId},
            success: function(data){                                  
                $("#resultsCanvas").html(data);
            },
            error: function(xhr, error, status){                
                console.log(xhr);
            }
        });

        //display all terms with exam types
        var chartCanvas = $(".chartDisplay");
        $(chartCanvas).attr({"class": "col-md-4"});
    }else{
        $("#examTypeRow").show();
    }
});
    function filterTermlyResults(){
        var isTermly = $("#termly").is(":checked");
    var getBaseURL = $("#getBaseURL").val();
    var subjects = new Array();
    var terms = new Array();  
    var examType = '';
    var studentId = $("#student_id").val();
    var sampleId = $("#sample_id").val();
    //show hidden fields
    $("#examTypeRow").show();

    $(".examSelected").each(function(index, element){
        if($(this).is(":checked")){
            if($(this).attr("value") != 'allExam'){
                examType = $(this).attr('value');
            }else{
                examType = 'bot'; //initialie it to bot
            }
        }
    });
    //push filter variables
    $(".chk-sub").each(function(index, element){           
        if($(this).is(":checked")){
            var checkedSubject = $(this).attr("value");
            if(checkedSubject != 'all') subjects.push(checkedSubject);
        }
    });
    
    $(".termSelected").each(function(index, element){
        if($(this).is(":checked")){
            var checkedTerm = $(this).attr("id");
            terms.push(checkedTerm);
        }
    });
    
    if(isTermly){
        $("#terms").show();
        $.ajax({
            type: "post",
            url: getBaseURL + 'index.php/User/filter_student_results',
            data: {type: 'termly', subjects: subjects, examType: examType, terms: terms, student_id: studentId, sample_id: sampleId},
            success: function(data){                                  
                $("#resultsCanvas").html(data);
            },
            error: function(xhr, error, status){                
                console.log(xhr);
            }
        });
    }
    
    }
$(document).on('change', '#termly, .chk-sub, .examSelected, #terms', function(event){
    filterTermlyResults();
});
