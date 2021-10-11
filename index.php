<?php require 'include/header.php'; ?>

<div class="videoSection">
    <?php
        $subscriptionProvider = new SubscriptionProvider($conn, $userLoggedInObj);
        $subscriptionVideos = $subscriptionProvider->getVideos();
        $videoGrid = new VideoGrid($conn, $userLoggedInObj->getUserName());

        if (User::isLoggedIn() && sizeof($subscriptionVideos) > 0){
            echo $videoGrid->create($subscriptionVideos, "Subscriptions", false);
        }
        echo $videoGrid->create(null, "Recommended", false);
    ?>
</div>

<?php require 'include/footer.php'; ?>
