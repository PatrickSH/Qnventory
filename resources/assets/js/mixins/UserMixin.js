export default {
    methods : {
        userData : function () {
            var data;
            data = JSON.parse(document.head.querySelector("[property~=user_data][content]").content);
            if( typeof data !== 'object')
                data = JSON.parse(data);
            return data;
        },

        refreshUserMeta : function () {
            axios.get('/user/refresh-session', {

            }).then(function (response) {
                document.head.querySelector("[property~=user_data][content]").content = JSON.stringify(response.data);
            }).catch(function (error) {
            });
        }
    }
}