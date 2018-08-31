<?php
  include 'lib/database.php';
  $db = new Database();
  include 'inc/header.php';

// SELECT QUERY FOR READ THE DATA
  $sql = "select * from contact_table";
  $read = $db->select($sql);



// DELETE QUERY FOR DELETE THE DATA
  $table = 'contact_table';
  if (isset($_GET['id'])) {
    $db->delete($table,$_GET['id']);
  }




 ?>
      <section>
        <div class="section_main">

          <?php
// FOR MSG AND STATUS OF ANY OPERATION
              if(isset($_GET['msg']) || isset($_GET['del'])){ ?>

                <div class="alert <?php if(isset($_GET['del'])){
                  echo "alert-danger";
                } else {
                  echo "alert-success";
                }
                ?> alert-dismissible fade in">
                  <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success! </strong>
                  <?php if(isset($_GET['del'])){
                    echo $_GET['del'];
                  } else {
                    echo $_GET['msg'];
                  }
                  ?>
                </div>

              <?php } ?>


          <div class="panel panel-primary">
            <div class="panel-heading">
              <span class="intro_panel">My Contact List</span>
              <span class="add pull-right">
                <button type="button" class="btn btn-success" name="button" onclick="window.location.href='addstu.php'"> Add New Contact  <i class="fas fa-plus-circle"></i></button>
              </span>
            </div>

            <div class="panel-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>


                <tbody>

                  <?php
// FETCH THE DATA
                  if($read) {

                    foreach ($read as $data) {

                   ?>

                  <tr>
                    <td><?php echo $data['Name']; ?></td>
                    <td><?php echo $data['Email']; ?></td>
                    <td><?php echo $data['Phone']; ?></td>
                    <td>

                      <a href="editstu.php?id=<?php echo urlencode($data['Id']);?>" class="btn btn-default" > <i class="fas fa-user-edit"></i></a>
                      <a href="index.php?id=<?php echo urlencode($data['Id']);?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" > <i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>

                  <?php
                    }
                  }
                  else {
                  echo "Data not available.";
                  }
                  ?>


                </tbody>


              </table>
            </div>
          </div>

        </div>
      </section>


<?php
  include 'inc/footer.php';
?>
