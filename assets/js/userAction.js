function subscribe(userTo,userFrom, button){
    if (userTo == userFrom){
        alert("You can't subscribe yourself");
        return;
    }
    $.post("ajax/subscribe.php", {userTo: userTo, userFrom: userFrom})
        .done(function (data){
        if (data != null){
            $(button).toggleClass("subscribe unsubscribe");
            let butonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";
            $(button).text(butonText+ " " + data);
        }else {
            alert("Something went wrong!");
        }
    })
}