<?php
$dirPath = __DIR__;
include($dirPath."/include/header.php");
?>
<input type="file" id="FilUploader" />
<script>
$("#FilUploader").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
        }
    });
</script>