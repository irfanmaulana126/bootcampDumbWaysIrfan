<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(!empty($_POST["film"])){
    if (count($_FILES) > 0) {
        if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
            $imgData = base64_encode(file_get_contents(addslashes($_FILES['photo']['tmp_name'])));
            $imageProperties = getimageSize($_FILES['photo']['tmp_name']);
            
            $sql = "INSERT INTO film (title, durasi, photo, rating ,deskripsi, id_genre, id_writer, id_director)
    VALUES ('".$_POST["title"]."','".$_POST["durasi"]."','".$imgData."','".$_POST["rating"]."','".$_POST["deskripsi"]."','".$_POST["id_genre"]."','".$_POST["id_writer"]."','".$_POST["id_director"]."')";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
        }
    }

}

if(!empty($_POST["director"])){

    $sql = "INSERT INTO director (name)
    VALUES ('".$_POST["name"]."')";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(!empty($_POST["genre"])){

    $sql = "INSERT INTO genre (name)
    VALUES ('".$_POST["name"]."')";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(!empty($_POST["writer"])){

    $sql = "INSERT INTO writer (name)
    VALUES ('".$_POST["name"]."')";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$sql = "SELECT * FROM genre";
$result_genre = $conn->query($sql);

$sql = "SELECT * FROM writer";
$result_writer = $conn->query($sql);

$sql = "SELECT * FROM director";
$result_director = $conn->query($sql);

$sql = "SELECT * FROM film";
$result_film = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Bootstrap Theme Simply Me</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  h5 {
      color:black;
  }
  label{
      color:black;
      font-size:12px;
  }
  body {
    font: 20px Montserrat, sans-serif;
    line-height: 1.8;
    color: #f5f6f7;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
    background-color: #1abc9c; /* Green */
    color: #ffffff;
  }
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #ffffff; /* White */
    color: #555555;
  }
  .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
  }
  .container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
  }
  .navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 12px;
    letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
    color: #1abc9c !important;
  }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Movie</a>
    </div>
  </div>
</nav>

<!-- Third Container (Grid) -->
<div class="container-fluid bg-3 text-center">    
<button data-toggle="modal" data-target="#film">Create Film</button>
<button data-toggle="modal" data-target="#director">Create Director</button>
<button data-toggle="modal" data-target="#genre">Create Genre</button>
<button data-toggle="modal" data-target="#writer">Create Writer</button>
  <h3 class="margin">The Movie</h3><br>
  <div class="row">
  <?php if ($result_film->num_rows > 0) {
                // output data of each row
                while($row = $result_film->fetch_assoc()) {?>
                <div class="col-sm-4">
                    <p><?=$row["title"]?>.</p>
                    <img src="data:image;base64,<?=$row["photo"]?>" class="img-responsive margin" style="width:130px" alt="Image">
                    
                    </div>
                <?php } } else {
                echo "Data Tidak ada";
                }?>
    

  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com">www.w3schools.com</a></p> 
</footer>



<!-- Modal -->
<div class="modal fade" id="film" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Film</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label>Durasi</label>
            <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Durasi">
        </div>

        <div class="form-group">
            <label>Rating</label>
            <input type="text" class="form-control" id="reting" name="rating" placeholder="Rating">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Genre</label>
            <select name="id_genre" class="form-control" id="exampleFormControlSelect1">
                <?php if ($result_genre->num_rows > 0) {
                // output data of each row
                while($row = $result_genre->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
                } else {
                echo "<option></option>";
                }?>
            
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Writer</label>
            <select name="id_writer" class="form-control" id="exampleFormControlSelect1">
            <?php if ($result_writer->num_rows > 0) {
                // output data of each row
                while($row = $result_writer->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
                } else {
                echo "<option></option>";
                }?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlSelect1">Director</label>
            <select name="id_director" class="form-control" id="exampleFormControlSelect1">
            <?php if ($result_director->num_rows > 0) {
                // output data of each row
                while($row = $result_director->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
                } else {
                echo "<option></option>";
                }?>
            </select>
        </div>
      </div>
      <div class="modal-footer">

      <input type="hidden" class="form-control" name="film" value="1">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="director" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Director</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            <input type="hidden" class="form-control" name="director" value="1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Genre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            <input type="hidden" class="form-control" name="genre" value="1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="writer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Writer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name">
            <input type="hidden" class="form-control" name="writer" value="1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
