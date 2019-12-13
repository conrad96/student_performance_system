<div class="col-md-12">
          <?php 
          if(!empty($performance)){
            ?>
            <table id="performanceTable" class="display" style="width:100%;">
              <thead>
                <tr>
                  <td>Student</td>
                  <td>TERM</td>
                  <td>EXAM</td>
                  <td>MTC</td>
                  <td>ENG</td>
                  <td>SCI</td>
                  <td>SST</td>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($performance as $result){
                    print '<tr>'. 
                          '<td>'.$result->student.'</td>'.
                          '<td>TERM 1</td>'.
                          '<td>BOT</td>'.
                          '<td>'.$result->t1_bot_mtc.'</td>'. 
                          '<td>'.$result->t1_bot_eng.'</td>'. 
                          '<td>'.$result->t1_bot_sci.'</td>'. 
                          '<td>'.$result->t1_bot_sst.'</td>'. 
                          '</tr>';
                  }
                ?>
              </tbody>
            </table>
            <?php 
          }else{
            print '<div class="col-md-12">
            <h3 class="alert alert-danger">No performance records found.</h3>
            </div>';
          }
          ?>            
          </div>

<script>
$("#performanceTable").DataTable();
</script>