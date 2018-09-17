<template>
    <div id="firstlogin">
        <form method="post" name="userDataForm">
            <div class="data-wrapper">
                <div class="step">
                    <h2>1. Your personal info</h2>
                    <div class="input-groups">
                        <div class="group radios">
                            <input type="radio" name="gender" v-model="gender" value="f"/>
                            <label>Female</label>
                            <input type="radio" name="gender" v-model="gender" value="m"/>
                            <label>Male</label>
                        </div>
                        <div class="group image">
                            <label>Show people how you look!</label>
                            <input type="file" class="input_field" v-on:change="onFileChange" name="image" />
                        </div>
                    </div>
                </div>
                <div class="step">
                    <h2>2. Your organization info</h2>
                    <div class="button_in_line">
                        <button class="bluebutton"
                                v-bind:class="{active : action == 'new'}"
                                v-bind:value="action"
                                v-on:click.prevent="action='new'">Start new organization</button>
                        <button class="bluebutton"
                                v-bind:class="{active : action == 'join'}"
                                v-bind:value="action"
                                v-on:click.prevent="action='join'">Join organization</button>
                    </div>
                    <transition name="slide-fade" mode="out-in">
                        <div class="input-groups organization-step" v-if="action == 'join'" key="join">
                            <div class="group">
                                <input type="text" name="organizationId" v-model="organizationId" placeholder="Organization ID" />
                            </div>
                        </div>
                        <div class="input-groups organization-step" v-else-if="action == 'new'" key="new">
                            <div class="group radios">
                                <input type="text" name="organizationName" v-model="organizationName" placeholder="Name of your organization" />
                                <input type="text" name="organizationAddress" v-model="organizationAddress" placeholder="Were are you located?" />
                            </div>
                        </div>
                    </transition>
                    <button name="submit" class="bluebutton" id="startNow"
                            v-bind:class="{ loading: isLoading, done: isDone }"
                            v-on:click.prevent="save">Start now!<span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <svg class="checkmark" v-bind:class="{active : isDone}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
                </div>
            </div>

            <!--<div class="button_in_line">
                <button
                    name="submit">Login<span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span></button>
            </div>-->
        </form>
    </div>
</template>
<script>
    import TalkerMixin from '../mixins/TalkerMixin';
    export default {
        data() {
            return {
                image : "",
                gender : "",
                action : "new",
                organizationId : "",
                organizationName : "",
                organizationAddress : "",
                isLoading : false,
                isDone : false,
            }
        },

        mixins: [TalkerMixin],

        methods : {
            save : function(){
                this.isLoading = true;
                var vm = this;
                axios.post(this.prepareURL('user/save-firstlogin'), {
                    user : {
                        gender : this.gender,
                        image : this.image,
                    },
                    organization : {
                        organizationId : this.organizationId,
                        organizationName : this.organizationName,
                        organizationAddress : this.organizationAddress
                    },
                    action : this.action
                }).then(function (response) {
                    vm.isLoading = false;
                    vm.isDone = true;
                    setTimeout(function(){
                        window.location.href = "/dashboard";
                    },1500)
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
    }
</script>
