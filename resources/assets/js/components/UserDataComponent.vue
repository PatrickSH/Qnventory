<template>
    <div id="firstlogin">
        <form method="post" name="userDataForm">
            <div class="input-groups">
                <p></p>
                <div class="group">
                    <input type="file" class="input_field" v-on:change="fileChanged" name="image" />
                    <input type="password" class="input_field" name="password"
                           placeholder="Password" />
                </div>
                <div class="group">
                    <input type="email" class="input_field" name="firstname"
                           placeholder="Firstname" />
                    <input type="text" class="input_field" name="lastname"
                           placeholder="Lastname" />
                </div>
            </div>
            <div class="button_in_line">
                <button
                    name="submit">Login<span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span></button>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                image : ""
            }
        },

        methods : {
            fileChanged : function(e){
                this.image = e.target.files[0]
                axios.post('http://api.freezermanager.dev.cc/user/save-meta', this.selectedFile)
                axios.post('http://api.freezermanager.dev.cc/user/save-meta', {
                    email: this.email,
                    password: this.password,
                }).then(function (response) {
                    cl.isLoadingLogin = false;
                    window.location.href = "user/firstlogin"
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },

        computed: {
        }
    }
</script>
