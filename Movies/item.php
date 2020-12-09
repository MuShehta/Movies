<?php
include "admin/connect.php";

$page_title = "Item"; //set page title
include "include/function.php"; 
include "include/header.php";
include "include/navbar.php";

$item_id = $_GET["id"];
$stmt = $conn -> prepare("select * from item where item_id = $item_id");
$stmt -> execute();
$count = $stmt -> rowCount();
// if id not found redirect to index page
if ($count == 0) {
    Header ("Location:index.php");
}
$item = $stmt -> fetch();

?>

<div class="item-php">
    <div class="container">  
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <img src="<?php echo 'admin/' . $item["image"] ?>" class="card-img" alt="...">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                    <!-- to display info of item  -->
                        <h2 class="card-title"><?php echo $item["name"] ?></h2>
                        <p class="card-text"><?php echo "Section : " . $item["section"] ?></p>
                        <p class="card-text"><?php echo "Type : " . $item["type"] ?></p>
                        <p class="card-text"><?php echo "Descripton : " . $item["description"] ?></p>
                        <a href="video.mp4" download type="button" class="btn btn-danger">Download</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- embeded video  -->
        <div class="video">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" controls src="video.mp4" autopaly=0></iframe>
            </div>
        </div>
        <div class="items">
            <?php
                // to define ection of item
                $item_name = $item['section'];
                $item_id = $item['item_id'];
                $stmt = $conn -> prepare("select * from item where section = '$item_name' and item_id != $item_id order by rand() limit 8");
                $stmt -> execute();
                $items = $stmt -> fetchAll();
                echo "<div class='row'>";
                // for on all items 
                foreach ($items as $item) {
                    ?>
                    
                        <div class="col-6 col-md-3">
                            <a href="item.php?id=<?php echo $item["item_id"] ?>">
                                <div class="footer-item" style="background:url('<?php echo 'admin/' . $item["image"] ?>')"> </div>
                            </a>
                        </div>
                    
               <?php
                }
                echo "</div>";
            ?>
        </div>
    </div>
</div>



<?php
include "include/footer.php";

?>