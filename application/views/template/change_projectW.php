
<?php 

	extract($_REQUEST);
     $prJ_id=$_REQUEST['prJ_id'];
     $qrypch ="SELECT proj_d.* FROM project_users as proj_u LEFT JOIN project_details as proj_d ON proj_u.project_id = proj_d.id where proj_u.user_id='$_SESSION[uid]' and proj_d.id='$prJ_id' and proj_d.flag='1'";

     $respch1 = mysqli_query($con,$qrypch);
     $rowpch1 = mysqli_fetch_assoc($respch1);
      $projIDnew=$rowpch1['id'];
   
       if(!empty($projIDnew))
       {
                
       } 

     $_SESSION['projID']=$projIDnew;

     if(!empty($projIDnew))
     {
             header("Location: dashboard");
             exit();
     }
    
?>