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

Vue.directive('open-model',function(el,binding){
   el.addEventListener('click',function(){
       var classOpen = "." + binding.value.bind;
       var modal = document.querySelector(classOpen);
       modal.classList += " active";
   });
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