function likeVideo(button, videoId){
    $.post('ajax/likeVideo.php', {videoId: videoId}).done(function (data) {
        let likeButton = $(button);
        let dislikeButton = $(button).siblings(".dislikeButton");
        likeButton.addClass("active");
        dislikeButton.removeClass("active");
        let result = JSON.parse(data);
        updateLikeValue(likeButton.find(".text"), result.likes);
        updateLikeValue(dislikeButton.find(".text"), result.dislikes);
    })
}

function updateLikeValue(element, number) {
    let likeCount = element.text() || 0;
    element.text(parseInt(likeCount) + parseInt(number));
}
