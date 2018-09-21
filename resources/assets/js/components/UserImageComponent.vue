<template>
    <div class="user-profile-img shadow"
         v-on:click="goToProfile"
         v-bind:style="{ backgroundImage: 'url(' + this.user.metas.image.value + ')' }">
    </div>
</template>
<script>
    import UserMixin from '../mixins/UserMixin';
    export default {
        mixins : [UserMixin],

        data(){
            return{
                user : this.userData()
            }
        },

        methods : {
            goToProfile : function(){
                window.location.href = "/profile"
            }
        }
    }
</script>