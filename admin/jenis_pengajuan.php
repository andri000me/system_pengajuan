<?php
    include '../system/koneksi.php';
    session_start();
    $logged_in = false;
    if (empty($_SESSION['email'])) {
        echo "<script type='text/javascript'>document.location='../login?proses=error ';</script>";
    }
    else {
        $logged_in = true;
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Jenis Pengajuan</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/dist/sweetalert.css">
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="../assets/img/sidebar.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
<?php
 $query_login = "SELECT * FROM user WHERE email ='$_SESSION[email]'";
    $result_login = mysqli_query($con, $query_login);
    if(!$result_login){
      die ("Query Error: ".mysqli_errno($con).
         " - ".mysqli_error($con));
    }
    $data_login = mysqli_fetch_assoc($result_login);
    $username = $data_login["username"];
?>
                    Pengajuan Pengadaaan <small>Barang & Training <br> <small>( Manajemen ) - <?php echo $username ?></small></small>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index">
                        <i class="pe pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="pengajuan">
                        <i class="pe pe-7s-note2"></i>
                        <p>Pengajuan</p>
                    </a>
                </li>
                <li>
                    <a href="riwayat">
                        <i class="pe pe-7s-timer"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li class="active">
                    <a data-toggle="collapse" href="#componentsExamples" aria-expanded="true">
                        <i class="pe-7s-server"></i>
                        <p>Master</p>
                    </a>
                    <div class="collapse in" id="componentsExamples">
                        <ul class="nav">
                            <li><a href="user">User</a></li>
                            <li class="active"><a href="jenis_pengajuan">Jenis Pengajuan</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="profil">
                        <i class="pe pe-7s-user"></i>
                        <p>Profil</p>
                    </a>
                </li>
                <li>
                    <a href="#" onclick = "logout()">
                        <i class="pe pe-7s-back"></i>
                        <p>Log out</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Jenis Pengajuan</h4>
                                    </div>  
                                    <div class="col-md-6" align="right">
                                        <a href="tambah_jenispengajuan">
                                            <button type="button" class="btn btn-primary btn-fill">
                                                <i class="fa fa-plus"></i> Tambah Jenis Pengajuan
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <form id="form_user"  action="?" method="get">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Pencarian : </label>
                                                <input type="text" name="cari" id="cari" class="form-control" placeholder="Pencarian..." >
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label><br></label>
                                            <button type="submit" rel="tooltip" class="btn btn-primary btn-fill">
                                                    <i class="fa fa-search"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>Jenis Pengajuan</th>
                                        <th>Deskripsi</th>
                                    	<th>Pengaturan</th>
                                    </thead>
                                    <tbody>

<?php
        if (isset($_GET['cari'])) {
            $jenispengajuan = ($_GET["cari"]);
                $query = "SELECT * FROM jenis_pengajuan WHERE jenis_pengajuan like '%$jenispengajuan%' ORDER BY id_jenis_pengajuan" ;
        }
        else{
            $query = "SELECT * FROM jenis_pengajuan ORDER BY id_jenis_pengajuan" ;
        }

      $result = mysqli_query($con, $query);
        if(!$result){
            die ("Query Error: ".mysqli_errno($con).
            " - ".mysqli_error($con));
        }

        if($result->num_rows == 0){
                                        echo "<tr>
                                            <td colspan='4' align='center'>
                                                Tidak ada data
                                                <br>
                                                <a href='jenis_pengajuan'>
                                                    <button type='button' class='btn btn-primary btn-fill btn-sm'>
                                                        <i class='fa fa-refresh'></i> Refresh data
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>";
        }
        else{
            $no = 1; 
            while($jenispengajuan = mysqli_fetch_assoc($result))
            {
                                        echo '<tr>
                                            <td>'.$no.'</td>
                                            <td>'.$jenispengajuan['jenis_pengajuan'].'</td>
                                            <td>'.$jenispengajuan['deskripsi'].'</td>
                                            <td>
                                                <button onclick="edit('.$jenispengajuan['id_jenis_pengajuan'].')" type="button" rel="tooltip" class="btn btn-primary btn-fill btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button onclick="hapus('.$jenispengajuan['id_jenis_pengajuan'].')" type="button" rel="tooltip" class="btn btn-danger btn-fill btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>';
                                        $no++;
            }
        }
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

    <script src="../assets/dist/sweetalert-dev.js"></script>
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>
	<script src="../assets/js/chartist.min.js"></script>
    <script src="../assets/js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="../assets/js/light-bootstrap-dashboard.js"></script>
	<script src="../assets/js/demo.js"></script>
    
<?php    
    echo'<script type="text/javascript">';
    if (isset($_GET['proses'])) {
        $proses = ($_GET["proses"]);
        if($proses == "hapus"){
            echo 'swal({
                    title: "Terhapus!",
                    text: "Jenis pengajuan telah ditambah.",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonColor: "#00ff00"
                })';
        }else if ($proses == "ubah"){
            echo 'swal({
                    title: "Terubah!",
                    text: "Jenis pengajuan telah diubah.",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonColor: "#00ff00"
                })';
        }else if ($proses == "tambah"){
            echo 'swal({
                    title: "Tertambah!",
                    text: "Jenis pengajuan telah ditambah.",
                    type: "success", 
                    showConfirmButton: true,
                    confirmButtonColor: "#00ff00"
                })';
        }
    }
    echo'</script>'
?> 
	<script type="text/javascript">
    	$(document).ready(function(){
        	demo.initChartist();
    	});

        function logout() {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin keluar ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00cc00", 
                confirmButtonText: "Logout",
                cancelButtonText: "Batal",
                closeOnConfirm: false
                },
            function(){
                document.location="../logout";
            })
        }
        function edit(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin mengubah jenis pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00ff00",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="edit_jenispengajuan?id="+id;
            })
        }       
        function hapus(id) {
            swal({
                title: "Konfirmasi ?",
                text: "Apakah anda ingin menghapus jenis pengajuan",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function(){
                document.location="edit_jenispengajuan?id="+id;
            })
        }
	</script>
</html>
