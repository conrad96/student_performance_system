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
                    //get return fields
                    $type = $examtype;
                    $term_title = (empty($term['title'])? $term : $term['title']);
                    $term_type = (empty($term['type'])? $examtype : $term['type']);
                    $obj_mtc = $term_type.'_'.strtolower($type).'_mtc';
                    $obj_eng = $term_type.'_'.strtolower($type).'_eng';
                    $obj_sci = $term_type.'_'.strtolower($type).'_sci';
                    $obj_sst= $term_type.'_'.strtolower($type).'_sst';                    

                  foreach($performance as $result){
                    print '<tr>'. 
                          '<td>'.$result->student.'</td>'.
                          '<td>'.$type.'</td>'.
                          '<td>'.$term_title.'</td>'.
                          '<td>'.(!empty($obj_mtc)? $obj_mtc : '').'</td>'. 
                          '<td>'.$obj_eng.'</td>'. 
                          '<td>'.$obj_sci.'</td>'. 
                          '<td>'.$obj_sst.'</td>'. 
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
