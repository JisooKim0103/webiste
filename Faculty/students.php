<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SEC - Enrolled Students</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>

<body>
  <?php 
  ob_start();
  include('session.php');
  include('header.php');
  include('../db/database.php');
    $ID = "";
    $idQuery = $connection->prepare("SELECT faculty_logid from faculty_credential where faculty_code = :code;");
    $idQuery->execute(array(":code" => $_SESSION['logged_faculty']));

    foreach($idQuery as $idrow)
    {
        $ID = $idrow['faculty_logid'];
    }

  ?>

  <!-- Page Content -->
  <div class="container-fluid">
      <div class="text-center"><h1>Student Listings</h1></div>
     <table id="table" class="table">
         <thead>
             <tr>
                 <th>Student</th>
                 <th>Program</th>
                 <th>Course taken (under)</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $query = "SELECT student.firstname, student.lastname, enrollmentlist.class_id, course.course_code, program.program_code,
                program.program_description from `student`
                inner join `enrollmentlist` on enrollmentlist.student_id = student.student_id 
                inner join `course` on course.course_id = enrollmentlist.class_id
                inner join `program` on program.program_id = enrollmentlist.program_id
                inner join `course_handled` on course_handled.course_id = enrollmentlist.class_id
                WHERE course_handled.faculty_id = :id;";
                $statement = $connection->prepare($query);
                $statement->execute([":id" => $ID]);

                foreach($statement as $row)
                {
                    echo "<tr>
                        <td>".$row['lastname'].", ".$row['firstname']."</td>
                        <td>".$row['program_code']." - ".$row['program_description']."</td>
                        <td>".$row['course_code']."</td>
                    </tr>";
                }


            ?>
         </tbody>
     </table>
  </div>
  <!-- Bootstrap core JavaScript -->
 <?php include('footer.php');?>
 <script>
$(document).ready( function () {
    $('#table').DataTable();
} );
</script>
</body>
</html>
