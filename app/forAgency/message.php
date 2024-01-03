<?php
    if(isset($_SESSION['message'])) :
?>

    <div class="alert alert-success alert-dismissible fade show col-md-4 col-10 mx-auto text-center" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php 
    unset($_SESSION['message']);
    endif;
?>