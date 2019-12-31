<?php 
              if(!empty($student)){
                $num_result_set = count($student)                ;
                if($num_result_set > 1 ){

                }else{
                  //one bar graph
                  print '<div id="chartContainer" class="chartDisplay-1"></div>';                  
                  $dataPoints = array();
                  $split_query_str = explode(',', $query_str);
                  $math = array();
                  $english = array();
                  $science = array();
                  $sst = array();
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
                        $science['label'] = 'English';
                        $science['y'] = $stud[$param];
                      }
                      if($subject_query_str[2] == 'sst'){
                        $sst['label'] = 'SST';
                        $sst['y'] = $stud[$param];
                      }
                    }
                  }
                  $dataPoints = array($math, $english, $science, $sst);                    
                }
              }
              ?>
<?php if(!empty($student)){ ?>  
          <script>
            window.onload = function () {         
            var term, type;                
            term = '<?= $term_title; ?>';
            type = '<?= $exam_type_title; ?>';
            
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
        <?php }else{ ?>
        <div class="alert alert-danger">
          <h4>Students' records not found.</h4>
        </div>
        <?php } ?>