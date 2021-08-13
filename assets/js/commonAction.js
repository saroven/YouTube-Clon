$(document).ready(function () {
  $(".navShowHide").on("click", function () {
    console.log("clicked");
    let main = $(".mainSectionContainer");
    let nav = $(".sideNavContainer");
    if (main.hasClass("leftPadding")) {
      nav.hide();
    } else {
      nav.show();
    }
    main.toggleClass("leftPadding");
  });
});
