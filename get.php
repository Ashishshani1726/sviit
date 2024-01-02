<?php
include "config.php";

if(isset($_POST['start'])){
    $start= mysqli_real_escape_string($conn,$_POST['start']);
    $sql =  "SELECT * FROM courses
    ORDER BY c_id DESC LIMIT $start, 2";
    $resultcl = mysqli_query($conn, $sql) or die("Query Failed.");
    if (mysqli_num_rows($resultcl) > 0) {
        while ($rowcl = mysqli_fetch_assoc($resultcl)) {

             $html = '<div class="item">
             <div class="cours-bx">
                 <div class="action-box">
                     <img src="./course/'.$rowcl["c_photo"].'" alt="">
                     <a href="#" class="btn">Read More</a>
                 </div>
                 <div class="info-bx text-center">
                 <h5><a href="#">'.$rowcl["c_name"].'</a></h5>
                     <span>';
                     $rowCourse = "SELECT * FROM course_type JOIN type ON course_type.type_id = type.type_id WHERE c_id = {$rowcl['c_id']}";
                     $resultC = mysqli_query($conn, $rowCourse) or die("Query Failed.");
                     if (mysqli_num_rows($resultC) > 0) {
                         $flag = true;
                         while ($rowc = mysqli_fetch_assoc($resultC)) {
                             if($flag == true){
                                 $html .= ''.$rowc["type_name"];
                                 $flag = false;
                             }else{
                                $html .= ','.$rowc["type_name"];
                             }

                         }
                     }
            $html .= '</span>
                </div>
                <div class="cours-more-info">
                    <div class="review">
                        <span>3 Review</span>
                        <ul class="cours-star">
                            <li class="active"><i class="fa fa-star"></i></li>
                            <li class="active"><i class="fa fa-star"></i></li>
                            <li class="active"><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                    <div class="price">
                        <del>' . $rowcl["price"] . '</del>
                        <h5>' . $rowcl["price"] . '</h5>
                    </div>
                </div>
            </div>
        </div>';


            
         echo $html;
        }
        
    }
}




?>