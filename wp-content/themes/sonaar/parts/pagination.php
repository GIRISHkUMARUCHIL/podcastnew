<?php
if( isset($paginationPrevButtonsText) && $paginationPrevButtonsText == '' || !isset($paginationPrevButtonsText) ){
        $paginationPrevButtonsText = __( 'Prev', 'sonaar-elementor' );
}
if( isset($paginationNextButtonsText) && $paginationNextButtonsText == '' || !isset($paginationNextButtonsText) ){
    $paginationNextButtonsText = __( 'Next', 'sonaar-elementor' );
}
?>

<div class="sonaar-pagination">
<button type="button" class="sr-paginateBack"><?php echo($paginationPrevButtonsText) ?></button>
<ul class="pagination"></ul>
<button type="button" class="sr-paginateNext"><?php echo($paginationNextButtonsText) ?></button>
</div>

