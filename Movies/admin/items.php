<?php

$page_title = "Items"; //set page title

include "connect.php"; // connect to database
include "include/function.php"; 
include "include/header.php";

echo "<a class='btn btn-primary' href='index.php'>Go To Index</a>";

$do = isset($_GET["do"]) ? $_GET["do"] : "manage"; //to know operation come from request
$para = isset($_GET["para"]) ? $_GET["para"] : "no";

// manage section
if ($do == 'manage' ||$do == 'movie' || $do == 'serice' || $do ==  "all" ) {
    // second condetion in stmt database in line 16 
    $second = ($para == "no") ? "" : "and item.type = '$para'";
    // Query put in database
    $query = ($do !== "all") ? "where section = '$do' $second " : "";
    // if post request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $do = $_POST["name"];
        $query = ($do !== "all") ? "where name like '%$do%' $second " : "";
    }

    $stmt = $conn -> prepare("SELECT * from item $query");
    $stmt -> execute();
    $items = $stmt -> fetchAll();
?>
<h1 class= "text-center">Manage Items</h1>
    <div class="container">
    <!-- form to get name of item to searched it in database  -->
    <form action="items.php" method="POST">
        <input type="text" class="form-control d-inline-block" name="name" style="width:300px" placeholder="Search for item">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <!-- table that contan the data  -->
    <table class="table table-bordered text-center" style="margin-top:10px">
        <thead class="thead-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // display data in table 
                    foreach($items as $row) {
                        echo "<tr>";
                            echo "<td>" . $row['item_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['description'] ."</td>";
                            echo "<td>" . $row["section"]. " " .$row['type'] . "</td>";
                            echo "<td> 
                                <a href='items.php?do=edit&item_id=". $row['item_id'] ."' class='btn btn-success' style='margin-right : 5px;'>Edit</a>'
                                <a href='items.php?do=delete&item_id=". $row['item_id'] ."' class='btn btn-danger confirm'>Delete</a>";
                            echo "</td>";
                        echo "</tr>";
                    }

                ?>
                
            </tbody>
        </table>
        <a class="btn btn-primary" href='items.php?do=add'>+ Add New Item</a>
        </div>
    <?php
}
// to add new element
elseif ($do == "add") {
    ?>
    <div class="container" style="width:350px">
     <form action="?do=insert" method="POST" enctype="multipart/form-data"> <!-- form for get data -->
     <!-- get name of item -->
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <!-- get category of item -->
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="cat">
                <option value="movie">Movie</option>
                <option value="serice">Serice</option>
            </select>
        </div>
        <!-- get type of movie -->
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type">
                <option value="action">Action</option>
                <option value="derama">Derama</option>
                <option value="horror">Horror</option>
                <option value="comdey">Comdey</option>
            </select>
        </div>
        <!-- get description of item -->
        <div class="form-group">
            <label>Description</label>
            <input type="text" class="form-control" name="desc">
        </div>

        <!-- if we need to add images -->
        <div class="form-group">
            <label>Main Image</label>
            <input type="file" class="form-control" name="main_img">
        </div>
        

        <!-- submit the form -->
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    </div>
<?php
}
// inser new item in database
elseif ($do == "insert") {

    // upper header
    echo "<h1 class='text-center'>Insert Show</h1>";
    echo "<div class='container'>";

    // if request method = post save data in database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // put data in vars 
        $name = $_POST["name"];
        $cat = $_POST["cat"];
        $type = $_POST["type"]; 
        $desc = $_POST["desc"];
        $main_img = $_FILES["main_img"];

        // make array of error 
        $errors = array();
        if (empty($name)) {$errors[] = "Name can't be empty"; }
        if (empty($main_img["name"])) {$errors[] = "Main Image can't be empty"; }
        if (empty($cat)) {$errors[] = "Category can't be empty"; }
        if (empty($type)) {$errors[] = "Typecan't be empty"; }
        if (empty($desc)) {$errors[] = "Description can't be empty"; }
        
        // loop throwing errors 
        foreach ($errors as $error) {
            echo "<div class= 'alert alert-danger'>" . $error . "</div>";
        }

        // if not found error save data 
        if (empty($errors)) {
            $main_name = "uploads/" . $name . rand(1 , 100000000000000000) . $main_img["name"];
            move_uploaded_file($main_img["tmp_name"] , $main_name);
            $stmt = $conn -> prepare("insert into item (name, description, section, type , image) values (?,?,?,?,?)");
                $stmt -> execute(array($name , $desc , $cat , $type , $main_name ));
                echo "<div class= 'alert alert-success'>" . $stmt -> rowCount() . " Record Inserted </div>";
        }

    }

    echo "</div>";
}
// delete item 
elseif ($do == 'delete') {
    // upper header 
    echo "<h1 class='text-center'>Delete Show</h1>";
        echo "<div class='container'>";
        // check if id of item valid
        $id = (isset($_GET["item_id"]) && is_numeric($_GET["item_id"])) ? intval($_GET["item_id"]) : 0;
        
        //check if id of item is existe
        $stmt = $conn->prepare("select * from item where item_id = ?");
        $stmt -> execute(array($id));
        $row = $stmt -> fetch();
        $count = $stmt->rowCount();

        // if item is existe delete it 
        if($count > 0) {
            // check the image of item
            $file_pointer = $row["image"];
            if (!unlink($file_pointer)) {  
                echo "<div class= 'alert alert-danger'>No such Item</div>";  
            }  
            else {  
                $stmt = $conn->prepare("delete from item where item_id = :id");
                $stmt->bindparam(":id" , $id);
                $stmt->execute();
                echo "<div class= 'alert alert-success'>Item Deleted</div>";      
            }     
        }
        echo "</div>";
}
// edit items
elseif($do == "edit") {
    // upper header
    echo "<h1 class='text-center'>Edit Item</h1>";
    $item_id = $_GET["item_id"]; // store id of item
    // get inforamtion of the item
    $stmt = $conn -> prepare("select * from item where item_id = ?");
    $stmt -> execute(array($item_id));
    $item = $stmt -> fetch();

    ?>
    <div class="container" style="width:350px">
    <!-- form to get updated data  -->
    <form action="?do=update&id=<?php echo $_GET["item_id"]; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value=<?php echo $item["name"] ?>>
            </div>
        <!-- get category of item -->
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="cat">
                <option value="movie" <?php if($item["section"] == 'movie') echo "selected" ?>>Movie</option>
                <option value="serice" <?php if($item["section"] == 'serice') echo "selected" ?>>Serice</option>
            </select>
        </div>
        <!-- get type of movie -->
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type">
                <option value="action" <?php if($item["type"] == 'action') echo "selected" ?>>Action</option>
                <option value="derama" <?php if($item["type"] == 'derama') echo "selected" ?>>Derama</option>
                <option value="horror" <?php if($item["type"] == 'horror') echo "selected" ?>>Horror</option>
                <option value="comdey" <?php if($item["type"] == 'comdey') echo "selected" ?>>Comdey</option>
            </select>
        </div>
        <!-- get description  -->
        <div class="form-group">
            <label>Description</label>
            <input type="text" class="form-control" name="desc" value=<?php echo $item["description"] ?>>
        </div>
        <div class="form-group">
            <label>Main Image</label>
            <input type="file" class="form-control" name="main_img">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
<?php  
}
// update database 
elseif ($do == 'update') {
    // upper header
    echo "<h1 class='text-center'>Update Show</h1>";
    echo "<div class='container'>"; // contaniner bootstrap
    // get item id come from request
    $id = (isset($_GET["id"]) && is_numeric($_GET["id"])) ? intval($_GET["id"]) : 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // put data in vars 
        $name = $_POST["name"];
        $cat = $_POST["cat"];
        $type = $_POST["type"]; 
        $desc = $_POST["desc"];
        $main_img = $_FILES["main_img"];

        // make array of error 
        $errors = array();
        if (empty($name)) {$errors[] = "Name can't be empty"; }
        if (empty($main_img["name"])) {$errors[] = "Main Image can't be empty"; }
        if (empty($cat)) {$errors[] = "Category can't be empty"; }
        if (empty($type)) {$errors[] = "Typecan't be empty"; }
        if (empty($desc)) {$errors[] = "Description can't be empty"; }
        
        // loop throwing errors 
        foreach ($errors as $error) {
            echo "<div class= 'alert alert-danger'>" . $error . "</div>";
        }
        // if not error up date in database
        if (empty($errors)) {
            $main_name = "uploads/" . $name . rand(1 , 100000000000000000) . $main_img["name"];
            move_uploaded_file($main_img["tmp_name"] , $main_name);
            $stmt = $conn -> prepare("update item set name = ? , section = ? , description = ? , type = ? , image = ? where item_id = ?");
            $stmt -> execute(array($name , $cat , $desc , $type, $main_name , $id));
            echo "<div class= 'alert alert-success'>" . $stmt -> rowCount() . " Show Updated </div>";
        }

    }

    echo "</div>";
}

// manage sections
else {
    echo "<div class= 'alert alert-danger'>No such Admin</div>";
}   
include "include/footer.php";

?>