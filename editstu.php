<?php
  include 'lib/database.php';
  $db = new Database();
  include 'inc/header.php';
  $x=0;
  $id = $_GET['id'];

  if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($db->connection , $_POST['name']);
    $email = mysqli_real_escape_string($db->connection , $_POST['email']);
    $phone = mysqli_real_escape_string($db->connection , $_POST['phone']);


//SOME CUSTOM VALIDATION

    if ($name == '') {
      $errname = "Name Field Must be Filled Up.";
      $x=1;
    }
    if($email == '') {
      $erremail = "Email Field Must be Filled Up.";
      $x=1;
    }
    if($phone == '') {
      $errphn = "Phone Field Must be Filled Up.";
      $x=1;
    }
//UPDATE SQL OPERATION
    if($x==0){
      if(isset($_GET['id'])){
        $sql = "update contact_table set
        Name = '$name',
        Email = '$email',
        Phone = '$phone'
        where Id=$id";

        $db->update($sql);
      }
    }
  }


//FETCH THE CURRENT VALUE
  $qry = "select * from contact_table where Id = $id";
  $data = $db->select($qry);
  $data = $data->fetch_assoc();




 ?>


 <section>
   <div class="section_main">

     <div class="panel panel-primary" style="min-height:460px;">
       <div class="panel-heading">
         <span class="intro_panel">Add New Sudent</span>
         <span class="add pull-right">
           <button type="button" class="btn btn-success" name="button" onclick="window.location.href='index.php'"> Back  <i class="fas fa-plus-circle"></i></button>
         </span>
       </div>

       <div class="panel-body">
         <div class="addform">
           <form class="" action="editstu.php?id=<?php echo urlencode($data['Id']);?>" method="post">
             <div class="single_form">
               <label for="name">Contact Name:</label>
               <input type="text" class="form-control" name="name" id="name" value="<?php echo $data["Name"]; ?>">
               <?php if (!empty($errname)) { ?>
                 <p><?php echo $errname; ?></p>
               <?php } ?>
             </div>

             <div class="single_form">
               <label for="email">Email:</label>
               <input type="email" class="form-control" name="email" id="email" value="<?php echo $data['Email']; ?>">
               <?php if (!empty($erremail)) {?>
                 <p><?php echo $erremail; ?></p>
               <?php } ?>
             </div>

             <div class="single_form">
               <label for="phn">Phone:</label>
               <input type="number" class="form-control" name="phone" id="phn" value="<?php echo $data['Phone']; ?>">
               <?php if (!empty($errphn)) {?>
                 <p><?php echo $errphn; ?></p>
               <?php } ?>
             </div>
             <p class="text-right"><button type="submit" class="btn btn-primary" name="submit">submit</button></p>

           </form>
         </div>
       </div>
     </div>

   </div>
 </section>








 <?php
   include 'inc/footer.php';
 ?>
