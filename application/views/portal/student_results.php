<?php 
              if(!empty($student)){
                // echo "<pre>";
                // print_r($query_params);
                // echo "</pre>";
                $params_counter = count($query_params);
                //echo $params_counter;                
                if($params_counter > 4 ){
                  //multi series bar charts
                  print '<div class="row chart-area">'.
                            '<div class="col-md-6">
                              <div id="chartContainer_term1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                            </div>
                            <div class="col-md-6">
                              <div id="chartContainer_term2" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>  
                            </div>
                        </div>';
                  print '<div class="row chart-area">
                            <div class="col-md-12">
                              <div id="chartContainer_term3" style="height: 370px; margin: 0px auto;"></div>
                            </div>
                        </div>';
                 
                  //logic to get respective terms
                  //term 1 data 
                  $t1_math_bot = $t1_eng_bot = $t1_sci_bot = $t1_sst_bot = array();                                                         
                  $t1_math_mot = $t1_eng_mot = $t1_sci_mot = $t1_sst_mot = array();                                                      
                  $t1_math_eot =  $t1_eng_eot = $t1_sci_eot = $t1_sst_eot = array();  
                  //term 2 
                  $t2_math_bot = $t2_eng_bot = $t2_sci_bot = $t2_sst_bot = array();                                                         
                  $t2_math_mot = $t2_eng_mot = $t2_sci_mot = $t2_sst_mot = array();                                                      
                  $t2_math_eot =  $t2_eng_eot = $t2_sci_eot = $t2_sst_eot = array();   
                  //term 3
                  $t3_math_bot = $t3_eng_bot = $t3_sci_bot = $t3_sst_bot = array();                                                         
                  $t3_math_mot = $t3_eng_mot = $t3_sci_mot = $t3_sst_mot = array();                                                      
                  $t3_math_eot =  $t3_eng_eot = $t3_sci_eot = $t3_sst_eot = array();   
                           
                  //initialise labels 
                  //term 1
                  $t1_math_bot['label'] = 'Math'; $t1_eng_bot['label'] = 'English'; $t1_sci_bot['label'] = 'Science'; $t1_sst_bot['label'] = 'SST';
                  $t1_math_mot['label'] = 'Math'; $t1_eng_mot['label'] = 'English'; $t1_sci_mot['label'] = 'Science'; $t1_sst_mot['label'] = 'SST';
                  $t1_math_eot['label'] = 'Math'; $t1_eng_eot['label'] = 'English'; $t1_sci_eot['label'] = 'Science'; $t1_sst_eot['label'] = 'SST';
                  //term 2
                  $t2_math_bot['label'] = 'Math'; $t2_eng_bot['label'] = 'English'; $t2_sci_bot['label'] = 'Science'; $t2_sst_bot['label'] = 'SST';
                  $t2_math_mot['label'] = 'Math'; $t2_eng_mot['label'] = 'English'; $t2_sci_mot['label'] = 'Science'; $t2_sst_mot['label'] = 'SST';
                  $t2_math_eot['label'] = 'Math'; $t2_eng_eot['label'] = 'English'; $t2_sci_eot['label'] = 'Science'; $t2_sst_eot['label'] = 'SST';
                  //term 3
                  $t3_math_bot['label'] = 'Math'; $t3_eng_bot['label'] = 'English'; $t3_sci_bot['label'] = 'Science'; $t3_sst_bot['label'] = 'SST';
                  $t3_math_mot['label'] = 'Math'; $t3_eng_mot['label'] = 'English'; $t3_sci_mot['label'] = 'Science'; $t3_sst_mot['label'] = 'SST';
                  $t3_math_eot['label'] = 'Math'; $t3_eng_eot['label'] = 'English'; $t3_sci_eot['label'] = 'Science'; $t3_sst_eot['label'] = 'SST';                  

                  foreach($student as $stud){
                    /** Term 1 */
                    //bot                   
                    $t1_math_bot['y'] = $stud['t1_bot_mtc'];
                    $t1_eng_bot['y'] = $stud['t1_bot_eng'];
                    $t1_sci_bot['y'] = $stud['t1_bot_sci'];
                    $t1_sst_bot['y'] = $stud['t1_bot_sst'];
                    //mot
                    $t1_math_mot['y'] = $stud['t1_mot_mtc'];
                    $t1_eng_mot['y'] = $stud['t1_mot_eng'];
                    $t1_sci_mot['y'] = $stud['t1_mot_sci'];
                    $t1_sst_mot['y'] = $stud['t1_mot_sst']; 
                    //eot
                    $t1_math_eot['y'] = $stud['t1_eot_mtc'];
                    $t1_eng_eot['y'] = $stud['t1_eot_eng'];
                    $t1_sci_eot['y'] = $stud['t1_eot_sci'];
                    $t1_sst_eot['y'] = $stud['t1_eot_sst'];    
                    
                    
                    /** Term 2 */
                    //bot                   
                    $t2_math_bot['y'] = $stud['t2_bot_mtc'];
                    $t2_eng_bot['y'] = $stud['t2_bot_eng'];
                    $t2_sci_bot['y'] = $stud['t2_bot_sci'];
                    $t2_sst_bot['y'] = $stud['t2_bot_sst'];
                    //mot
                    $t2_math_mot['y'] = $stud['t2_mot_mtc'];
                    $t2_eng_mot['y'] = $stud['t2_mot_eng'];
                    $t2_sci_mot['y'] = $stud['t2_mot_sci'];
                    $t2_sst_mot['y'] = $stud['t2_mot_sst']; 
                    //eot
                    $t2_math_eot['y'] = $stud['t2_eot_mtc'];
                    $t2_eng_eot['y'] = $stud['t2_eot_eng'];
                    $t2_sci_eot['y'] = $stud['t2_eot_sci'];
                    $t2_sst_eot['y'] = $stud['t2_eot_sst']; 
                    
                    
                    /** Term 3 */
                    //bot                   
                    $t3_math_bot['y'] = $stud['t3_bot_mtc'];
                    $t3_eng_bot['y'] = $stud['t3_bot_eng'];
                    $t3_sci_bot['y'] = $stud['t3_bot_sci'];
                    $t3_sst_bot['y'] = $stud['t3_bot_sst'];
                    //mot
                    $t3_math_mot['y'] = $stud['t3_mot_mtc'];
                    $t3_eng_mot['y'] = $stud['t3_mot_eng'];
                    $t3_sci_mot['y'] = $stud['t3_mot_sci'];
                    $t3_sst_mot['y'] = $stud['t3_mot_sst']; 
                    //eot
                    $t3_math_eot['y'] = $stud['t3_eot_mtc'];
                    $t3_eng_eot['y'] = $stud['t3_eot_eng'];
                    $t3_sci_eot['y'] = $stud['t3_eot_sci'];
                    $t3_sst_eot['y'] = $stud['t3_eot_sst'];                                                                  
                  }
                  //term 1
                  $dataPointsExams_bot_1 = array($t1_math_bot, $t1_eng_bot, $t1_sci_bot, $t1_sst_bot);
                  $dataPointsExams_mot_1 = array($t1_math_mot, $t1_eng_mot, $t1_sci_mot, $t1_sst_mot);
                  $dataPointsExams_eot_1 = array($t1_math_eot, $t1_eng_eot, $t1_sci_eot, $t1_sst_eot);
                  //term 2
                  $dataPointsExams_bot_2 = array($t2_math_bot, $t2_eng_bot, $t2_sci_bot, $t2_sst_bot);
                  $dataPointsExams_mot_2 = array($t2_math_mot, $t2_eng_mot, $t2_sci_mot, $t2_sst_mot);
                  $dataPointsExams_eot_2 = array($t2_math_eot, $t2_eng_eot, $t2_sci_eot, $t2_sst_eot);
                  //term 3
                  $dataPointsExams_bot_3 = array($t3_math_bot, $t3_eng_bot, $t3_sci_bot, $t3_sst_bot);
                  $dataPointsExams_mot_3 = array($t3_math_mot, $t3_eng_mot, $t3_sci_mot, $t3_sst_mot);
                  $dataPointsExams_eot_3 = array($t3_math_eot, $t3_eng_eot, $t3_sci_eot, $t3_sst_eot);
                  //load scripts
                  ?>
                  <!-- term 1 -->
                  <script type="text/javascript">                  
                     // window.onload = function () {                        
                      var chart = new CanvasJS.Chart("chartContainer_term1", {
                        animationEnabled: true,
                        title:{ text: "Term 1" },
                        axisY: { title: "Marks" },
                        legend: { cursor:"pointer", itemclick : toggleDataSeries},
                        toolTip: {shared: true, content: toolTipFormatter},
                        data: [{type: "bar",showInLegend: true,name: "BOT",color: "yellow",dataPoints: <?php echo json_encode($dataPointsExams_bot_1, JSON_NUMERIC_CHECK); ?>}, {type: "bar",showInLegend: true,name: "MOT",color: "silver",dataPoints: <?php echo json_encode($dataPointsExams_mot_1, JSON_NUMERIC_CHECK); ?>}, {type: "bar",showInLegend: true,name: "EOT",color: "#A57164",dataPoints: <?php echo json_encode($dataPointsExams_eot_1, JSON_NUMERIC_CHECK); ?>}]
                      });
                      chart.render();

                      function toolTipFormatter(e) {
                        var str = "";
                        var total = 0 ;
                        var str3;
                        var str2 ;
                        for (var i = 0; i < e.entries.length; i++){
                          var str1 = "<span style= 'color:"+e.entries[i].dataSeries.color + "'>" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
                          total = e.entries[i].dataPoint.y + total;
                          str = str.concat(str1);
                        }
                        str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
                        str3 = "<span style = 'color:Tomato'>AVG: </span><strong>" + (total / 3) + "</strong><br/>";
                        return (str2.concat(str)).concat(str3);
                      }

                      function toggleDataSeries(e) {
                        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                          e.dataSeries.visible = false;
                        }
                        else {
                          e.dataSeries.visible = true;
                        }
                        chart.render();
                      }

                     // }
                  </script>
                  <!-- term 2 -->
                  <script type="text/javascript">                  
                     // window.onload = function () {                        
                      var chart = new CanvasJS.Chart("chartContainer_term2", {
                        animationEnabled: true,
                        title:{ text: "Term 2" },
                        axisY: { title: "Marks" },
                        legend: { cursor:"pointer", itemclick : toggleDataSeries},
                        toolTip: {shared: true, content: toolTipFormatter},
                        data: [{type: "bar",showInLegend: true,name: "BOT",color: "yellow",dataPoints: <?php echo json_encode($dataPointsExams_bot_2, JSON_NUMERIC_CHECK); ?>}, {type: "bar",showInLegend: true,name: "MOT",color: "silver",dataPoints: <?php echo json_encode($dataPointsExams_mot_2, JSON_NUMERIC_CHECK); ?>}, {type: "bar",showInLegend: true,name: "EOT",color: "#A57164",dataPoints: <?php echo json_encode($dataPointsExams_eot_2, JSON_NUMERIC_CHECK); ?>}]
                      });
                      chart.render();

                      function toolTipFormatter(e) {
                        var str = "";
                        var total = 0 ;
                        var str3;
                        var str2 ;
                        for (var i = 0; i < e.entries.length; i++){
                          var str1 = "<span style= 'color:"+e.entries[i].dataSeries.color + "'>" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
                          total = e.entries[i].dataPoint.y + total;
                          str = str.concat(str1);
                        }
                        str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
                        str3 = "<span style = 'color:Tomato'>AVG: </span><strong>" + (total / 3) + "</strong><br/>";
                        return (str2.concat(str)).concat(str3);
                      }

                      function toggleDataSeries(e) {
                        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                          e.dataSeries.visible = false;
                        }
                        else {
                          e.dataSeries.visible = true;
                        }
                        chart.render();
                      }

                     // }
                  </script>
                  <!-- term 3 -->
                  <script type="text/javascript">                  
                     // window.onload = function () {                        
                      var chart = new CanvasJS.Chart("chartContainer_term3", {
                        animationEnabled: true,
                        title:{ text: "Term 3" },
                        axisY: { title: "Marks" },
                        legend: { cursor:"pointer", itemclick : toggleDataSeries},
                        toolTip: {shared: true, content: toolTipFormatter},
                        data: [{type: "bar",showInLegend: true,name: "BOT",color: "yellow",dataPoints: <?php echo json_encode($dataPointsExams_bot_3, JSON_NUMERIC_CHECK); ?>}, {type: "bar",showInLegend: true,name: "MOT",color: "silver",dataPoints: <?php echo json_encode($dataPointsExams_mot_3, JSON_NUMERIC_CHECK); ?>}, {type: "bar",showInLegend: true,name: "EOT",color: "#A57164",dataPoints: <?php echo json_encode($dataPointsExams_eot_3, JSON_NUMERIC_CHECK); ?>}]
                      });
                      chart.render();

                      function toolTipFormatter(e) {
                        var str = "";
                        var total = 0 ;
                        var str3;
                        var str2 ;
                        for (var i = 0; i < e.entries.length; i++){
                          var str1 = "<span style= 'color:"+e.entries[i].dataSeries.color + "'>" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
                          total = e.entries[i].dataPoint.y + total;
                          str = str.concat(str1);
                        }
                        str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
                        str3 = "<span style = 'color:Tomato'>AVG: </span><strong>" + (total / 3) + "</strong><br/>";
                        return (str2.concat(str)).concat(str3);
                      }

                      function toggleDataSeries(e) {
                        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                          e.dataSeries.visible = false;
                        }
                        else {
                          e.dataSeries.visible = true;
                        }
                        chart.render();
                      }

                     // }
                  </script>
                  <?php 
                }else{
                  //one bar graph
                  print '<div id="chartContainer" class="chartDisplay" style="width: 85%;"></div>';                  
                  $dataPoints = array();
                  $split_query_str = explode(',', $query_str);
                  $math = array(); $english = array(); $science = array(); $sst = array();
                  //extract term and exam
                  $title = ''; $exam_title = ''; 
                  if(!empty($split_query_str)){
                    if($split_query_str[0] == 't1'){
                      $title = 'Term 1';                    
                    }
                    if($split_query_str[0] == 't2'){
                      $title = 'Term 2';                    
                    }
                    if($split_query_str[0] == 't3'){
                      $title = 'Term 3';                    
                    }
                    //exam types
                    if($split_query_str[1] == 'bot'){
                      $exam_title = 'BOT';                    
                    }
                    if($split_query_str[1] == 'mot'){
                      $exam_title = 'MOT';                    
                    }
                    if($split_query_str[1] == 'eot'){
                      $exam_title = 'EOT';                    
                    }
                    foreach($split_query_str as $param){
                      //explode last element on t1_bot_mtc
                      $subject_query_str = explode('_', $param);
                      foreach($student as $stud){
                        if($subject_query_str[2] == 'mtc'){
                          $math['label'] = 'Math';
                          $math['y'] = $stud[$param];
                        }
                        if($subject_query_str[2] == 'eng'){
                          $english['label'] = 'English';
                          $english['y'] = $stud[$param];
                        }
                        if($subject_query_str[2] == 'sci'){
                          $science['label'] = 'Science';
                          $science['y'] = $stud[$param];
                        }
                        if($subject_query_str[2] == 'sst'){
                          $sst['label'] = 'SST';
                          $sst['y'] = $stud[$param];
                        }
                      }
                    }
                  }
                  $dataPoints = array($math, $english, $science, $sst);  
                  ?>
                  <script>
                      window.onload = function () {         
                      var term = '<?= $title; ?>'; 
                      var type = '<?= $exam_title; ?>';                                       
                      var chart = new CanvasJS.Chart("chartContainer", {
                          animationEnabled: true,
                          theme: "light2",
                          title:{
                            text: term + '  ' + type + " Results"
                          },
                          axisY: {
                            title: "Marks"
                          },
                          data: [{
                            type: "column",
                            yValueFormatString: "#,##0.## ",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                          }]
                      });
                        
                      chart.render();                   
                      }  
                  </script>             
                  <?php                    
                }                
              }else{ ?>
                <div class="alert alert-danger">
                  <h4>Students' records not found.</h4>
                </div>
                <?php } ?>                      
