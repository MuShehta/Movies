<?php
include "admin/connect.php";
$page_title = "Home";
include "include/function.php";
include "include/header.php";
include "include/navbar.php";

// if user search by name
if ( isset($_GET["search"])) {
    $search = $_GET["search"];
    $stmt = $conn -> prepare("select * from item where lower(name) like '%$search%' order by rand()");
    $stmt -> execute();
    $items = $stmt -> fetchAll();

} 
// if user search by section 
elseif (isset($_GET["section"])) {
    $section = $_GET["section"];
    $stmt = $conn -> prepare("select * from item where section = '$section' order by rand()");
    $stmt -> execute();
    $items = $stmt -> fetchAll();  
}
// if user search by type 
elseif (isset($_GET["type"])) {
    $type = $_GET["type"];
    $stmt = $conn -> prepare("select * from item where type = '$type' order by rand()");
    $stmt -> execute();
    $items = $stmt -> fetchAll();
}
// to next page not finish yet

// defalut to display all items 
else {
    $number = isset($_GET["page"]) ?  $_GET["page"] : 1;
    $page = ($number-1) * 12;
    $stmt = $conn -> prepare("SELECT * FROM item LIMIT 12 OFFSET $page;");
    $stmt -> execute();
    $items = $stmt -> fetchAll();
}
?>

<div class="flex-contanier">
    <div class="row">
        <div class="right-side col-md-3 col-lg-2">
            <!-- category of movies  -->
            <div class="cat" style="margin-bottom:15px">
                <div class="header">قائمة الاقسام</div>
                <ul class="cat-ul">
                    <li><a href="index.php?section=movie">افلام</a></li>
                    <li><a href="index.php?section=serice">مسلسلات</a></li>
                    <li><a href="index.php?type=horror">رعب</a></li>
                    <li><a href="index.php?type=action">اكشن</a></li>
                    <li><a href="index.php?type=comdey">كوميدي</a></li>
                    <li><a href="index.php?type=derama">دراما</a></li>
                </ul>
            </div>
            <!-- random movie  -->
            <?php 
                $stmt = $conn -> prepare("SELECT * FROM item ORDER BY RAND() LIMIT 1;");
                    $stmt -> execute();
                    $item = $stmt -> fetch();
            ?>
            <div class="cat" style="margin-bottom:15px">
                <div class="header">فيلم عشوائى</div>
                <a href="item.php?id=<?php echo $item["item_id"] ?>"><img class="img-auto" src="<?php echo 'admin/' . $item["image"] ?>"></a>
            </div>
            <!-- social media  -->
            <div class="cat">
                <div class="header">المواقع الإجتماعية</div>
                <ul class="social-ul">
                    <li><i class="fab fa-facebook-square"></i></li>
                    <li><i class="fab fa-linkedin"></i></li>
                    <li><i class="fab fa-youtube"></i></li>
                    <li><i class="fab fa-twitter-square"></i></li>
                    <li><i class="fab fa-instagram-square"></i></li>
                </ul>
            </div>

        </div>
        
        <!-- left side of side  -->
        <div class="left-side col-md-9 col-lg-10">
            <div class="row justify-content-around">
                <?php
                // to loop throw all items 
                    foreach ($items as $item){
                    
                ?>

                <div class="col-6 col-lg-2">
                <!-- set info of item  -->
                    <a href="item.php?id=<?php echo $item["item_id"] ?>">
                        <div class="item" style="background:url('<?php echo 'admin/' . $item["image"] ?>')">
                            <div class="over-lay"></div>
                            <div class="info text-center">
                                <h2><?php echo $item["name"] ?></h2>
                                <p><?php echo $item["description"] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                    }
                ?>
            </div>
            <div class="number text-center">
                <div class="page">page</div>
                <?php 
                    $count = count_item("item", "") / 12;
                    for ($x = 1; $x <= $count; $x++) {
                        echo "<a href='index.php?page=$x'>$x</a>";
                    }
                ?>
            </div>
        </div>
        
    </div>
</div>

<?php
include "include/footer.php";
?>