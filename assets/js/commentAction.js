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
    $.post('ajax/likeComment.php', {commentId: commentId, videoId: videoId }).done(function (data) {
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
    });
}
function dislikeComment(commentId, button, videoId) {

}