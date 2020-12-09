
// to set height of item 
function set_height(item) {
    var item_width = $(item).innerWidth();
    $(item).innerHeight(item_width * 1.42);

    // to make height 
    function myFunction() {
        var item_width = $(item).innerWidth();
        $(item).innerHeight(item_width * 1.42);
    }
    // change height on resize
    window.addEventListener("resize", myFunction);
}
set_height(".left-side .item"); //height of main image 
set_height(".footer-item");     //height of footer image in item page


