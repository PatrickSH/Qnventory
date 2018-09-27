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

//Closes modal and shows loading
Vue.directive('show-loading-close',function(el){
    el.addEventListener("click", function(){
        el.classList += " loading";

        setTimeout(function(){
            el.classList.remove('loading');
            el.classList += " done";
            el.querySelector(".checkmark").classList += " active";
        },400);

        var modal = el.closest(".modal");

        setTimeout(function () {
            modal.classList += " hide"; //Animation last 0.5s
        },2000);

        setTimeout(function () {
            modal.classList += " remove";
        },2550);
    });
});

Vue.directive('open-model',function(el,binding){

   el.addEventListener('click',function(){
       var classOpen = "." + binding.value.bind;
       var modal = document.querySelector(classOpen);
       modal.classList.remove("remove");
       modal.classList.remove("hide");
       modal.querySelector("input").value = "";
       modal.querySelector("textarea").value = "";
       modal.querySelector(".checkmark").classList.remove("active");
       modal.querySelector("button").classList.remove("done");
       modal.classList += " active";
   });

   //Detect click outside modal to close it
   function closeOnOutsideClick(e){
       var classOpen = "." + binding.value.bind;
       var modal = document.querySelector(classOpen);
       var close = '.overlay';
       if (event.target.matches(close)) {

           modal.classList += " hide"; //Animation last 0.5s

           setTimeout(function () {
               modal.classList += " remove";
           },550);
       }
   }
   document.body.addEventListener('click', closeOnOutsideClick);

});

Vue.directive('request-qr-codes',function (el,binding) {
   el.addEventListener('click',function () {
       el.classList += " loading";

       var modal = el.closest(".modal");
       var amount = modal.querySelector(".amount").value;

       axios.post('https://api.qnventory.com/qrcodes/request', {
           amount : amount
       }).then(function (response) {
          console.log(response);
          el.classList.remove("loading");
          el.classList += " done";
          el.querySelector("svg").classList += " active";
          setTimeout(function(){
              modal.classList.remove("active");
          },2000)
       }).catch(function (error) {
           console.log(error);
       });
   });
});