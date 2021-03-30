<?php include("includes/header.php"); ?>
<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();
$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql = "SELECT * FROM photos ORDER BY id ASC LIMIT {$paginate->offset()}, {$paginate->items_per_page}";
$photos = Photo::find_by_query($sql);
?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">
<?php
foreach ($photos as $photo): 
?>

    <div class="col-xs-6 col-md-3">
        <a href="photo.php?photo_id=<?php echo $photo->id; ?>" class="thumbnail">
            <img class="home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
        </a>
    </div>


<?php endforeach; ?>
</div>
<div class="row">
    <ul class="pager">
<?php
if ($paginate->page_total() > 1) {
    if ($paginate->has_next_page() && $paginate->has_previous_page()) {
        echo "
        <li class='previous'><a href='index.php?page={$paginate->previous_page()}'>Previous</a></li>
        <form class='target_form' action='' method='GET'>
            <input class='page_input' type='text' name='page' value='{$paginate->current_page}'>
        </form>
        <p class='total_pages'> of {$paginate->page_total()} pages</p>
        <li class='next'><a href='index.php?page={$paginate->next_page()}'>Next</a></li>
        ";
    } elseif (!$paginate->has_next_page()) {
        echo "
        <li class='previous'><a href='index.php?page={$paginate->previous_page()}'>Previous</a></li>
        <form class='target_form' action='' method='GET'>
            <input class='page_input' type='text' name='page' value='{$paginate->current_page}'>
        </form>
        <p class='total_pages'> of {$paginate->page_total()} pages</p>";
    } else {
        echo "
        <form class='target_form' action='' method='GET'>
            <input class='page_input' type='text' name='page' value='{$paginate->current_page}'>
        </form>
        <p class='total_pages'> of {$paginate->page_total()} pages</p>
        <li class='next'><a href='index.php?page={$paginate->next_page()}'>Next</a></li>
        ";
    }
}
?>
    </ul>
</div>
            
          
         

            </div>

</div>


            <!-- Blog Sidebar Widgets Column -->

        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
