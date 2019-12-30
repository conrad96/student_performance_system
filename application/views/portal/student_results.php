<?php 
              if(!empty($student)){
                  exit(print_r($student));
                
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
          <div id="chartContainer" class="chartDisplay"></div>
        <?php }else{ ?>
        <div class="alert alert-danger">
          <h4>Students' records not found.</h4>
        </div>
        <?php } ?>