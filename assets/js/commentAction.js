function postComment(button, postedBy, videoId, replyTo, containerClass)
{
    let textarea = $(button).siblings('textarea');
    let commentText = textarea.val();
    textarea.val("");

    if (commentText){
        $.post("ajax/postComment.php", { commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replyTo})
            .done(function (comment) {
                $("." + containerClass).prepend(comment);
            })
    }else{
        alert("You can't post empty comment.");
    }
}

function toggleReply(button) {
    let parent = $(button).closest(".itemContainer");
    let commentForm = parent.find(".commentForm").first();
    commentForm.toggleClass('hidden');
}
function likeComment(commentId, button, videoId) {
    $.post('ajax/likeComment.php', {commentId: commentId, videoId: videoId }).done(function (numToChange) {
        let likeButton = $(button);
        let dislikeButton = $(button).siblings(".dislikeButton");
        likeButton.addClass("active");
        dislikeButton.removeClass("active");

        let likesCount = $(button).siblings(".likesCount");
        updateLikeValue(likesCount, numToChange);

        if (numToChange < 0){
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up.png");
        }else{
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up-active.png");
        }
        dislikeButton.find("img:first").attr("src","assets/images/icons/thumb-down.png");
    });
}
function dislikeComment(commentId, button, videoId) {

}
function updateLikeValue(element, number) {
    let likeCount = element.text() || 0;
    element.text(parseInt(likeCount) + parseInt(number));
}