function likeVideo(button, videoId){
    $.post('ajax/likeVideo.php', {videoId: videoId}).done(function (data) {
        let likeButton = $(button);
        let dislikeButton = $(button).siblings(".dislikeButton");
        likeButton.addClass("active");
        dislikeButton.removeClass("active");
        let result = JSON.parse(data);
        updateLikeValue(likeButton.find(".text"), result.likes);
        updateLikeValue(dislikeButton.find(".text"), result.dislikes);

        if (result.likes < 0){
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up.png");
        }else{
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up-active.png");
        }
        dislikeButton.find("img:first").attr("src","assets/images/icons/thumb-down.png");
    })
}
function dislikeVideo(button, videoId){
    $.post('ajax/dislikeVideo.php', {videoId: videoId}).done(function (data) {
        let dislikeButton = $(button);
        let likeButton = $(button).siblings(".likeButton");
        dislikeButton.addClass("active");
        likeButton.removeClass("active");
        let result = JSON.parse(data);
        updateLikeValue(dislikeButton.find(".text"), result.dislikes);
        updateLikeValue(likeButton.find(".text"), result.likes);

        if (result.dislikes < 0){
            dislikeButton.removeClass("active");
            dislikeButton.find("img:first").attr("src","assets/images/icons/thumb-down.png");
        }else{
            dislikeButton.find("img:first").attr("src","assets/images/icons/thumb-down-active.png");
        }
        likeButton.find("img:first").attr("src","assets/images/icons/thumb-up.png");
    })
}

function updateLikeValue(element, number) {
    let likeCount = element.text() || 0;
    element.text(parseInt(likeCount) + parseInt(number));
}
