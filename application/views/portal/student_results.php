<?php 
              if(!empty($student)){
                $math = array();
                $english = array();
                $science = array();
                $sst = array();

                $obj_mtc = $term.'_'.strtolower($exam_type_title).'_mtc';
                $obj_eng = $term.'_'.strtolower($exam_type_title).'_eng';
                $obj_sci = $term.'_'.strtolower($exam_type_title).'_sci';
                $obj_sst = $term.'_'.strtolower($exam_type_title).'_sst';
                $counter = 0;

                //initialise
                $math['label'] = 'Math';
                $math['y'] = $student[$counter][$obj_mtc];

                $english['label'] = 'English';
                $english['y'] = $student[$counter][$obj_eng];

                $science['label'] = 'Science';
                $science['y'] = $student[$counter][$obj_sci];

                $sst['label'] = 'SST';
                $sst['y'] = $student[$counter][$obj_sst];  

                //assign to datapoints
                $dataPoints = array($math, $english, $science, $sst);
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
          <div id="chartContainer" style="height: 370px; width: 50%;"></div>
        <?php }else{ ?>
        <div class="alert alert-danger">
          <h4>Students' records not found.</h4>
        </div>
        <?php } ?>