<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DMIS - Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>

<body>
  <?php 
  ob_start();
  include('session.php');
  include('header.php');
  include('../db/database.php');
  ?>

  <!-- Page Content -->
  <div class="container-fluid">
     <table class="table">
         <thead>
             <tr>
                 <th>Student</th>
                 <th>Program</th>
                 <th>Course</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $query = "SELECT 
                student.firstname, student.lastname, student.program_id, program.program_code, program.program_description 
                from `student` INNER JOIN `program`
                ON student.program_id = program.program_id;";
                $statement = $connection->prepare($query);
                $statement->execute();

                foreach($statement as $row)
                {
                    echo "<tr>
                        <td>".$row['lastname'].", ".$row['firstname']."</td>
                        <td>".$row['program_code']."</td>
                        <td>".$row['program_description']."</td>
                    </tr>";
                }


            ?>
         </tbody>
     </table>
  </div>
  <!-- Bootstrap core JavaScript -->
 <?php include('footer.php');?>
</body>
</html>
