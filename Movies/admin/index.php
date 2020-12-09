<?php
include "connect.php";
$page_title = "Home";
include "include/function.php";
include "include/header.php";
login_as_admin(); // check if admin was register

// sections in this site to display it and sent in requsets 
$sections = array ("All Items" => "" , "Movie" => "where section = 'movie'" , "Serice"  => "where section = 'serice'",
 "Movie Drama"  => "where section = 'movie' and type = 'derama'"
, "Movie Action" => "where section = 'movie' and type = 'action'" , "Movie Horror"  => "where section = 'movie' and type = 'horror'",
 "Movie Comdey"  => "where section = 'movie' and type = 'comdey'" , "Serice Derama"  => "where section = 'serice' and type = 'derama'",
  "Serice Action"  => "where section = 'serice' and type = 'action'", "Serice Horror"  => "where section = 'serice' and type = 'horror'" ,
   "Serice Comdey"  => "where section = 'serice' and type = 'comdey'");

?>
<div class="container">
    <div class="row">
        <?php foreach ($sections as $item => $item_v){ ?>
            <div class="index-margin">
                <!-- send data whit two para first to section and secont to type  -->
                <a href=<?php echo "items.php?do=" .strtolower(str_replace(" ","&para=",$item))?>>
                    <div class="index-item text-center"  style="background: brown">  
                        <h3 class="h2"><?php echo $item ?></h3>
                        <p><?php echo count_item("item" , $item_v)  // get number of element in database ?></p>
                    </div>
                </a>
            </div>
    <?php } ?>
    </div>
</div>
<!-- button to log out from site  -->
<a class='btn btn-danger' href='logout.php'>Log Out</a>

<?php
include "include/footer.php"
?>