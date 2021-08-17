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
    <script>
        $("form").submit(function () {
            $("#loadingModal").modal("show");
        })
    </script>
    <!-- Modal -->

    <div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loadingModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Please Wait. This might take a while.
                    <img src="assets/images/icons/loading-spinner.gif" alt="loading-spinner">
                </div>
            </div>
        </div>
    </div>
<?php require 'include/footer.php'; ?>