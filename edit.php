<?php
require_once('./includes/db.php');

if($_POST) {
  global $mysqli;

  $id = $_POST['id'];
  $fullname = $_POST['fullname'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $mobile = $_POST['mobile'];
  $temperature = $_POST['temperature'];
  $covid19_diagnosed = $_POST['covid19_diagnosed'];
  $covid19_encounter = $_POST['covid19_encounter'];
  $vaccinated = $_POST['vaccinated'];
  $nationality = $_POST['nationality'];

  $update_query = "UPDATE `persons` SET
    `fullname` = '{$fullname}',
    `gender` = '{$gender}',
    `age` = '{$age}',
    `mobile` = '{$mobile}',
    `temperature` = '{$temperature}',
    `covid19_diagnosed` = '{$covid19_diagnosed}',
    `covid19_encounter` = '{$covid19_encounter}',
    `vaccinated` = '{$vaccinated}',
    `nationality` = '{$nationality}'
    WHERE `id` = {$id};";

    if ($mysqli->query($update_query)) {
        header('Location: records.php');
      die();
    }

    if ($mysqli->errno) {
      die("Could not update table: %s<br /> {$mysqli->error}");
    }
}

if($_GET && $_GET['id']) {
  global $mysqli;

  $id = $_GET['id'];

  $select_query = "SELECT * FROM `persons` WHERE `id` = {$id};";

  $result = $mysqli->query($select_query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $fullname = $row['fullname'];
    $gender = $row['gender'];
    $age = $row['age'];
    $mobile = $row['mobile'];
    $temperature = $row['temperature'];
    $covid19_diagnosed = $row['covid19_diagnosed'];
    $covid19_encounter = $row['covid19_encounter'];
    $vaccinated = $row['vaccinated'];
    $nationality = $row['nationality'];
  } else {
    header('Location: records.php');
    die();
  }

  if ($mysqli->errno) {
      die("Could query table: %s<br /> {$mysqli->error}");
  }

  $mysqli->close();
} else {
  header('Location: records.php');
  die();
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
            <h1 class="m-0">Edit Form</h1>
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
        <!-- Small boxes (Stat box) -->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="fullname">Name</label>
              <input type="text" class="form-control form-control-border" id="fullname" name="fullname" placeholder="Fullname" value="<?php echo $fullname ?>"required>
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select class="custom-select" name="gender">
                <option value="female" <?php echo $gender == 'female' ? 'selected' : '' ?> >Female</option>
                <option value="male" <?php echo $gender == 'male' ? 'selected' : '' ?> >Male</option>
              </select>
            </div>
            <div class="form-group">
              <label for="age">Age</label>
              <input type="number" class="form-control form-control-border" id="age" name="age" placeholder="Age" value="<?php echo $age ?>" required>
            </div>
            <div class="form-group">
              <label for="mobile">Mobile No.</label>
              <input type="text" class="form-control form-control-border" id="mobile" name="mobile" placeholder="Mobile" value="<?php echo $mobile ?>">
            </div>
            <div class="form-group">
              <label for="temperature">Body Temp.</label>
              <input type="text" class="form-control form-control-border" id="temperature" name="temperature" placeholder="Body Temp." value="<?php echo $temperature ?>"required>
            </div>
            <div class="form-group">
              <label>COVID-19 DIAGNOSED: (YES/NO)</label>
              <select class="custom-select" name="covid19_diagnosed">
                <option value="0"<?php echo $covid19_diagnosed == '0' ? 'selected' : '' ?> >No</option>
                <option value="1"<?php echo $covid19_diagnosed == '1' ? 'selected' : '' ?> >Yes</option>
              </select>
            </div>
            <div class="form-group">
              <label>COVID-19 encounter: (YES/NO)</label>
              <select class="custom-select" name="covid19_encounter">
                <option value="0"<?php echo $covid19_encounter == '0' ? 'selected' : '' ?> >No</option>
                <option value="1"<?php echo $covid19_encounter == '1' ? 'selected' : '' ?> >Yes</option>
              </select>
            </div>
            <div class="form-group">
              <label>VACINATED: (YES/NO)</label>
              <select class="custom-select" name="vaccinated">
                <option value="1"<?php echo $vaccinated == '1' ? 'selected' : '' ?> >Yes</option>
                <option value="0"<?php echo $vaccinated == '0' ? 'selected' : '' ?> >No</option>
              </select>
            </div>
            <div class="form-group">
              <label>Nationality</label>
              <select  class="custom-select" name="nationality">
                <option value="<?php echo $nationality ?>"><?php echo ucfirst($nationality) ?></option>
                <option> - </option>
                <option value="philippines">Philippines</option>
                <option value="afghan">Afghan</option>
                <option value="albanian">Albanian</option>
                <option value="algerian">Algerian</option>
                <option value="american">American</option>
                <option value="andorran">Andorran</option>
                <option value="angolan">Angolan</option>
                <option value="antiguans">Antiguans</option>
                <option value="argentinean">Argentinean</option>
                <option value="armenian">Armenian</option>
                <option value="australian">Australian</option>
                <option value="austrian">Austrian</option>
                <option value="azerbaijani">Azerbaijani</option>
                <option value="bahamian">Bahamian</option>
                <option value="bahraini">Bahraini</option>
                <option value="bangladeshi">Bangladeshi</option>
                <option value="barbadian">Barbadian</option>
                <option value="barbudans">Barbudans</option>
                <option value="batswana">Batswana</option>
                <option value="belarusian">Belarusian</option>
                <option value="belgian">Belgian</option>
                <option value="belizean">Belizean</option>
                <option value="beninese">Beninese</option>
                <option value="bhutanese">Bhutanese</option>
                <option value="bolivian">Bolivian</option>
                <option value="bosnian">Bosnian</option>
                <option value="brazilian">Brazilian</option>
                <option value="british">British</option>
                <option value="bruneian">Bruneian</option>
                <option value="bulgarian">Bulgarian</option>
                <option value="burkinabe">Burkinabe</option>
                <option value="burmese">Burmese</option>
                <option value="burundian">Burundian</option>
                <option value="cambodian">Cambodian</option>
                <option value="cameroonian">Cameroonian</option>
                <option value="canadian">Canadian</option>
                <option value="cape verdean">Cape Verdean</option>
                <option value="central african">Central African</option>
                <option value="chadian">Chadian</option>
                <option value="chilean">Chilean</option>
                <option value="chinese">Chinese</option>
                <option value="colombian">Colombian</option>
                <option value="comoran">Comoran</option>
                <option value="congolese">Congolese</option>
                <option value="costa rican">Costa Rican</option>
                <option value="croatian">Croatian</option>
                <option value="cuban">Cuban</option>
                <option value="cypriot">Cypriot</option>
                <option value="czech">Czech</option>
                <option value="danish">Danish</option>
                <option value="djibouti">Djibouti</option>
                <option value="dominican">Dominican</option>
                <option value="dutch">Dutch</option>
                <option value="east timorese">East Timorese</option>
                <option value="ecuadorean">Ecuadorean</option>
                <option value="egyptian">Egyptian</option>
                <option value="emirian">Emirian</option>
                <option value="equatorial guinean">Equatorial Guinean</option>
                <option value="eritrean">Eritrean</option>
                <option value="estonian">Estonian</option>
                <option value="ethiopian">Ethiopian</option>
                <option value="fijian">Fijian</option>
                <option value="filipino">Filipino</option>
                <option value="finnish">Finnish</option>
                <option value="french">French</option>
                <option value="gabonese">Gabonese</option>
                <option value="gambian">Gambian</option>
                <option value="georgian">Georgian</option>
                <option value="german">German</option>
                <option value="ghanaian">Ghanaian</option>
                <option value="greek">Greek</option>
                <option value="grenadian">Grenadian</option>
                <option value="guatemalan">Guatemalan</option>
                <option value="guinea-bissauan">Guinea-Bissauan</option>
                <option value="guinean">Guinean</option>
                <option value="guyanese">Guyanese</option>
                <option value="haitian">Haitian</option>
                <option value="herzegovinian">Herzegovinian</option>
                <option value="honduran">Honduran</option>
                <option value="hungarian">Hungarian</option>
                <option value="icelander">Icelander</option>
                <option value="indian">Indian</option>
                <option value="indonesian">Indonesian</option>
                <option value="iranian">Iranian</option>
                <option value="iraqi">Iraqi</option>
                <option value="irish">Irish</option>
                <option value="israeli">Israeli</option>
                <option value="italian">Italian</option>
                <option value="ivorian">Ivorian</option>
                <option value="jamaican">Jamaican</option>
                <option value="japanese">Japanese</option>
                <option value="jordanian">Jordanian</option>
                <option value="kazakhstani">Kazakhstani</option>
                <option value="kenyan">Kenyan</option>
                <option value="kittian and nevisian">Kittian and Nevisian</option>
                <option value="kuwaiti">Kuwaiti</option>
                <option value="kyrgyz">Kyrgyz</option>
                <option value="laotian">Laotian</option>
                <option value="latvian">Latvian</option>
                <option value="lebanese">Lebanese</option>
                <option value="liberian">Liberian</option>
                <option value="libyan">Libyan</option>
                <option value="liechtensteiner">Liechtensteiner</option>
                <option value="lithuanian">Lithuanian</option>
                <option value="luxembourger">Luxembourger</option>
                <option value="macedonian">Macedonian</option>
                <option value="malagasy">Malagasy</option>
                <option value="malawian">Malawian</option>
                <option value="malaysian">Malaysian</option>
                <option value="maldivan">Maldivan</option>
                <option value="malian">Malian</option>
                <option value="maltese">Maltese</option>
                <option value="marshallese">Marshallese</option>
                <option value="mauritanian">Mauritanian</option>
                <option value="mauritian">Mauritian</option>
                <option value="mexican">Mexican</option>
                <option value="micronesian">Micronesian</option>
                <option value="moldovan">Moldovan</option>
                <option value="monacan">Monacan</option>
                <option value="mongolian">Mongolian</option>
                <option value="moroccan">Moroccan</option>
                <option value="mosotho">Mosotho</option>
                <option value="motswana">Motswana</option>
                <option value="mozambican">Mozambican</option>
                <option value="namibian">Namibian</option>
                <option value="nauruan">Nauruan</option>
                <option value="nepalese">Nepalese</option>
                <option value="new zealander">New Zealander</option>
                <option value="ni-vanuatu">Ni-Vanuatu</option>
                <option value="nicaraguan">Nicaraguan</option>
                <option value="nigerien">Nigerien</option>
                <option value="north korean">North Korean</option>
                <option value="northern irish">Northern Irish</option>
                <option value="norwegian">Norwegian</option>
                <option value="omani">Omani</option>
                <option value="pakistani">Pakistani</option>
                <option value="palauan">Palauan</option>
                <option value="panamanian">Panamanian</option>
                <option value="papua new guinean">Papua New Guinean</option>
                <option value="paraguayan">Paraguayan</option>
                <option value="peruvian">Peruvian</option>
                <option value="polish">Polish</option>
                <option value="portuguese">Portuguese</option>
                <option value="qatari">Qatari</option>
                <option value="romanian">Romanian</option>
                <option value="russian">Russian</option>
                <option value="rwandan">Rwandan</option>
                <option value="saint lucian">Saint Lucian</option>
                <option value="salvadoran">Salvadoran</option>
                <option value="samoan">Samoan</option>
                <option value="san marinese">San Marinese</option>
                <option value="sao tomean">Sao Tomean</option>
                <option value="saudi">Saudi</option>
                <option value="scottish">Scottish</option>
                <option value="senegalese">Senegalese</option>
                <option value="serbian">Serbian</option>
                <option value="seychellois">Seychellois</option>
                <option value="sierra leonean">Sierra Leonean</option>
                <option value="singaporean">Singaporean</option>
                <option value="slovakian">Slovakian</option>
                <option value="slovenian">Slovenian</option>
                <option value="solomon islander">Solomon Islander</option>
                <option value="somali">Somali</option>
                <option value="south african">South African</option>
                <option value="south korean">South Korean</option>
                <option value="spanish">Spanish</option>
                <option value="sri lankan">Sri Lankan</option>
                <option value="sudanese">Sudanese</option>
                <option value="surinamer">Surinamer</option>
                <option value="swazi">Swazi</option>
                <option value="swedish">Swedish</option>
                <option value="swiss">Swiss</option>
                <option value="syrian">Syrian</option>
                <option value="taiwanese">Taiwanese</option>
                <option value="tajik">Tajik</option>
                <option value="tanzanian">Tanzanian</option>
                <option value="thai">Thai</option>
                <option value="togolese">Togolese</option>
                <option value="tongan">Tongan</option>
                <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                <option value="tunisian">Tunisian</option>
                <option value="turkish">Turkish</option>
                <option value="tuvaluan">Tuvaluan</option>
                <option value="ugandan">Ugandan</option>
                <option value="ukrainian">Ukrainian</option>
                <option value="uruguayan">Uruguayan</option>
                <option value="uzbekistani">Uzbekistani</option>
                <option value="venezuelan">Venezuelan</option>
                <option value="vietnamese">Vietnamese</option>
                <option value="welsh">Welsh</option>
                <option value="yemenite">Yemenite</option>
                <option value="zambian">Zambian</option>
                <option value="zimbabwean">Zimbabwean</option>
              </select>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info">UPDATE</button>
              <a href="records.php">
                <button type="button" class="btn btn-default float-right">Cancel</button>
              </a>
            </div>
          </div>
        </div>
        </form>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
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
</body>
</html>
