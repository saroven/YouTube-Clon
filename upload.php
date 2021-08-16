<?php
require 'include/header.php';
require 'include/classes/VideoDetailsFormProvider.php';
$formProvider = new VideoDetailsFormProvider($conn);
?>
<div class="column">
<?php
echo $formProvider->createUploadForm();
?>
</div>
<?php require 'include/footer.php'; ?>