<template>
    <div id="userData">
        <profile-presenter v-bind:current-image="currentImage"></profile-presenter>
        <div class="operation-area">
            <ul>
                <li v-on:click="show = 'user'" v-bind:class="{active : show == 'user'}">Profile</li>
                <li v-on:click="show = 'org'" v-bind:class="{active : show == 'org'}">Organization</li>
            </ul>
            <transition name="slide-fade" mode="out-in">
                <div class="data-form" v-if="show == 'user'" key="user">
                    <form method="post" name="userDataForm">
                        <div class="input-groups">
                            <div class="group radios">
                                <input type="radio" name="gender" v-model="gender" value="m"/>
                                <label>Male</label>
                                <input type="radio" name="gender" v-model="gender" value="f"/>
                                <label>Female</label>
                            </div>
                            <div class="group image">
                                <label>Profile image</label>
                                <input type="file" class="input_field" v-on:change="onFileChange" name="image" />
                            </div>
                        </div>
                        <button name="submit" class="bluebutton"
                                v-bind:class="{ loading: isLoading, done: isDone }"
                                v-on:click.prevent="saveUser">Save<span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <svg class="checkmark" v-bind:class="{active : isDone}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
                    </form>
                </div>
                <div class="data-form" v-else-if="show == 'org'" key="org">
                    <form method="post" name="userDataForm">
                        <div class="input-groups">
                            <div class="group">
                                <input type="text" placeholder="ej"/>
                            </div>
                        </div>
                    </form>
                </div>
            </transition>
        </div>
    </div>
</template>
<script>
    import TalkerMixin from '../mixins/TalkerMixin';
    import UserMixin from '../mixins/UserMixin'
    import ProfilePresenter from './user-profile/ProfilePresenter';

    export default {
        components:{
            ProfilePresenter
        },
        mixins: [TalkerMixin,UserMixin],
        data() {
            return {
                image : "",
                show : "user",
                user : this.userData(),
                gender : "",
                isLoading : false,
                isDone : false,
                currentImage : this.userData().metas.image.value
            }
        },

        methods : {
            saveUser : function(){
                this.isLoading = true;
                var vm = this;
                axios.post(this.prepareURL('user/save-meta'), {
                    user : {
                        gender : this.gender,
                        image : this.image,
                    }
                }).then(function (response) {
                    vm.refreshUserMeta();
                    vm.isLoading = false;
                    vm.isDone = true;
                    setTimeout(function(){
                        vm.currentImage = vm.userData().metas.image.value;
                    },1000);
                }).catch(function (error) {
                    vm.isLoading = false;
                });
            },
            saveOrg : function(){
                this.isLoading = true;
                var vm = this;
                axios.post(this.prepareURL('user/save-firstlogin'), {
                    organization : {
                        organizationId : this.organizationId,
                        organizationName : this.organizationName,
                        organizationAddress : this.organizationAddress
                    },
                }).then(function (response) {
                    vm.isLoading = false;
                    vm.isDone = true;
                }).catch(function (error) {
                    this.isLoading = false;
                });
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },

        watch: {
          show : function(){
              console.log(this.show);
          }
        },

        mounted(){
          this.gender = this.user.metas.gender.value;
        },

        computed: {
        }
    }
</script>
