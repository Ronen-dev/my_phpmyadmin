<?php  
  session_start();
  require_once '../check_session/connect_mysql.php';
  require_once '../check_session/needAuth.php';
  if (isset($_GET['db']))
  {
    $db = $_GET['db'];
    mysqli_select_db($connect, $_GET['db']);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My_PhpMyAdmin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include("navig.php");
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tables
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Accueil</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Tables
                            </li>
                            <?php echo "<a href=\"sql.php?db=$db\">"?>
                            <button class="btn btn-info btn-xs pull-right">
                                <i class="fa fa-code"></i> SQL
                            </button>
                            <?php echo "</a>"?>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Tables de la base de données <?php echo $db;?></h2>
                        <?php
                            if (isset($_GET['success']))
                                echo "<ol class='breadcrumb' style='background: rgba(112, 255, 141, 1);'>
                                        <li>
                                            <i class='fa fa-check'></i> " . $_GET['success'] . "
                                        </li>
                                    </ol>";
                            else if (isset($_GET['error']))
                                echo "<ol class='breadcrumb' style='background: rgba(255, 112, 112, 1);'>
                                        <li>
                                            <i class='fa fa-remove'></i> MySQL error : " . $_GET['error'] ."
                                        </li>
                                    </ol>";
                        ?>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tables</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $db = $_GET['db'];
                                        if (!empty($connect))
                                        {
                                          $query = "show tables";
                                          $result = mysqli_query($connect, $query);
                                          if (!$result)
                                          {
                                            echo "ERROR";
                                          }
                                          while ($data = mysqli_fetch_array($result))
                                          {
                                            echo "<tr>";
                                            echo "<td><a href='affiche_contenu.php?db=" . $db . "&tb=" . $data[0] . "'>" . $data[0] ."</a></td>";
                                            echo "<td><a href='affiche_contenu.php?db=" . $db . "&tb=" . $data[0] . "'><i class='fa fa-fw fa-file'></i>Afficher</a><a href='insert_contenu.php?db=" . $db . "&tb=" . $data[0] . "'><i class='fa fa-fw fa-pencil'></i>Insérer</a><a href='clean_table.php?db=" . $db . "&tb=" . $data[0] . "'><i class='fa fa-fw fa-trash-o'></i>Vider</a><a href='delete_table.php?db=" . $db . "&tb=" . $data[0] . "'><i class='fa fa-fw fa-times-circle'></i>Supprimer</a></td>";
                                            echo "</tr>";
                                          }  
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <h2>Ajouter une nouvelle table</h2>
                            <div class="col-lg-3">
                                <?php echo "<form action='add_table.php?db=" . $db . "' method='POST' accept-charset='UTF-8' enctype='multipart/form-data' role='add'>"; ?>
                                    <div class="form-group">
                                        <label>Nouvelle table :</label>
                                        <input type="text" name="tab" class="form-control" placeholder="Nom de la table">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre de colonne :</label>
                                        <input type="text" name="col" class="form-control" placeholder="Entrez la valeur">
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit Button</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <!-- Affichage tableau + scroling + search -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').dataTable();
        } );
    </script>
</body>

</html>
