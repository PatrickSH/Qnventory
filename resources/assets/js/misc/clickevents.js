//Handles clicks on elements that are not in component scope
Vue.directive('custom-click', function (el) {
    el.addEventListener("click", function(){
        var modal = el.closest(".modal");
        modal.classList += " hide"; //Animation last 0.5s
        setTimeout(function () {
            modal.classList += " remove";
        },550);
    });
});