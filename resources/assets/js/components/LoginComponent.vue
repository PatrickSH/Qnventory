<template>
    <div id="login">
        <form method="post" name="login">
            <div class="input-groups">
                <div class="group">
                    <input type="email" class="input_field" name="email"
                           v-model="email"
                           placeholder="E-mail" />
                    <input type="password" class="input_field" name="password"
                           v-model="password"
                           placeholder="Password" />
                </div>
                <div class="group" v-bind:class="isCreate">
                    <input type="email" class="input_field" name="firstname"
                           v-model="firstname"
                           placeholder="Firstname" />
                    <input type="text" class="input_field" name="lastname"
                           v-model="lastname"
                           placeholder="Lastname" />
                </div>
            </div>
            <div class="button_in_line">
                <button
                    v-bind:class="{ enabled: showCreate == false, loading: isLoadingLogin == true }"
                    v-on:click="doLogin"
                    v-bind:disabled="isLoadingLogin"
                    name="submit">Login<span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span></button>
                <button
                    v-bind:class="{ enabled: showCreate == true, loading: isLoadingCreate == true }"
                    v-on:click="doCreateUser"
                    v-bind:disabled="isLoadingCreate"
                    name="submit">Create user<span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span></button>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        props: ['message'],
        data() {
            return {
                email : "",
                password : "",
                firstname : "",
                lastname : "",
                showCreate : false,
                isLoadingLogin : false,
                isLoadingCreate : false
            }
        },

        methods : {
            doLogin : function(event){
                event.preventDefault();
                var cl = this;

                if(this.showCreate){ //Create is open close it first
                    this.showCreate = false;
                }else{ //We have not create open so send post
                    cl.isLoadingLogin = true;
                    axios.post('/user/login', {
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

            doCreateUser : function(event){
                event.preventDefault();
                var cl = this;
                if(this.showCreate){ //Create is open send request
                    cl.isLoadingCreate = true;
                    axios.post('/user/create', {
                        email: this.email,
                        password: this.password,
                        firstname: this.firstname,
                        lastname: this.lastname
                    }).then(function (response) {
                        if(response.status == 200){
                            cl.showCreate = false;
                            cl.isLoadingCreate = false;
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                }else{ //Craete is not open, so open it
                    this.showCreate = true;
                }
            }
        },

        computed: {

            isCreate : function(){
                return this.showCreate ? 'enabled' : 'disabled';
            }
        }
    }
</script>
