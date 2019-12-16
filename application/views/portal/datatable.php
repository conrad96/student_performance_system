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
                    $term_type = (empty($term['type'])? $termtype : $term['type']);
                    $obj_mtc = $term_type.'_'.strtolower($type).'_mtc';
                    $obj_eng = $term_type.'_'.strtolower($type).'_eng';
                    $obj_sci = $term_type.'_'.strtolower($type).'_sci';
                    $obj_sst= $term_type.'_'.strtolower($type).'_sst';                    
                            
                    for($i = 0; $i <= 1399; $i++ ){
                      print '<tr>'. 
                          '<td><a href="'.base_url().'index.php/User/student/'.$performance[$i]['id'].'/'.$performance[$i]['sample_id'].'">'.$performance[$i]['student'].'</a></td>'.
                          '<td>'.$term_title.'</td>'.
                          '<td>'.$type.'</td>'.
                          '<td>'.$performance[$i][ $obj_mtc].'</td>'. 
                          '<td>'.$performance[$i][ $obj_eng].'</td>'. 
                          '<td>'.$performance[$i][ $obj_sci].'</td>'. 
                          '<td>'.$performance[$i][ $obj_sst].'</td>'. 
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
