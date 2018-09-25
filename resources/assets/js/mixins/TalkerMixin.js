export default{
    methods:{
        prepareURL : function(path){
            return "https://api.qnventory.com/" + path;
        },
        getMetaString : function(name){
            var meta = document.head.querySelector("[property~="+name+"][content]").content;
            return meta;
        }
    }
}