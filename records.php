<?php
require_once('./includes/db.php');

$success_insert = false;

if($_POST) {
  global $mysqli;

  $fullname = $_POST['fullname'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $mobile = $_POST['mobile'];
  $temperature = $_POST['temperature'];
  $covid19_diagnosed = $_POST['covid19_diagnosed'];
  $covid19_encounter = $_POST['covid19_encounter'];
  $vaccinated = $_POST['vaccinated'];
  $nationality = $_POST['nationality'];

  $inser_query = "INSERT INTO `persons`
  (`fullname`, `age`, `mobile`, `temperature`, `covid19_diagnosed`, `covid19_encounter`, `vaccinated`, `nationality`)
  VALUES('{$fullname}', '{$age}', '{$mobile}', '${temperature}', '{$covid19_diagnosed}', '{$covid19_encounter}', '{$vaccinated}', '{$nationality}');";


  if ($mysqli->query($inser_query)) {
      $success_insert = true;
  }

  if ($mysqli->errno) {
      die("Could not insert record into table: %s<br /> {$mysqli->error}");
  }

  $mysqli->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
require('./includes/head.php');
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<?php
require('./includes/navbar.php');
require('./includes/sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Records</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Mobile</th>
                <th>Temperature</th>
                <th>Covid19 Diagnosed</th>
                <th>Covid19 Encounter</th>
                <th>Vaccinated</th>
                <th>Nationality</th>
                <th>Actions</th>
              </tr>
            </thead>
            <?php
              $records_query = 'SELECT * FROM `persons`';
              $result = $mysqli->query($records_query);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <td><?php echo $row['fullname'] ?></td>
              <td><?php echo $row['gender'] ?></td>
              <td><?php echo $row['age'] ?></td>
              <td><?php echo $row['mobile'] ?></td>
              <td><?php echo $row['temperature'] ?></td>
              <td><?php echo $row['covid19_diagnosed'] ? 'Yes' : 'No' ?></td>
              <td><?php echo $row['covid19_encounter'] ? 'Yes' : 'No' ?></td>
              <td><?php echo $row['vaccinated'] ? 'Yes' : 'No' ?></td>
              <td><?php echo $row['nationality'] ?></td>
              <td><a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a> | <a class="delete-btn" href="delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
              <th scope="row" colspan="11">No Records</th>
            </tr>
            <?php
            }
            mysqli_free_result($result);
            $mysqli->close();
          ?>
          </table>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Case Study 2 - DICT 10
    <div class="float-right d-none d-sm-inline-block">
      Galeon - Nakila - Enterina
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
require('./includes/footer_scripts.php')
?>
<script>
  const delete_btns = document.querySelectorAll('.delete-btn');

  delete_btns.forEach(el => el.addEventListener('click', event => {
    if (!confirm('Are you sure you want to delete?')) {
      event.preventDefault();
    }
  }));

</script>
</body>
</html>
