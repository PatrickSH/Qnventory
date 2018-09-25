<template>
    <div class="organization-switcher">
        <label>Active organization</label>
        <select name="organizations"
                v-model="activeOrg"
                >
            <option v-for="org in orgs" v-bind:value="org.id">{{ org.name }}</option>
        </select>
    </div>
</template>
<script>
    import UserMixin from "../mixins/UserMixin";

    export default {
        mixins : [UserMixin],

        data(){
            return {
                orgs : this.userData().organizations,
                activeOrg : this.userData().active_org,
            }
        },
        watch : {
            activeOrg : function(e){
                var vm = this;
                axios.post('/set-active-org',{
                    active_org : vm.activeOrg
                }).then(function () {
                    location.reload();
                }).catch(function () {
                    
                })
            }
        },

        mounted(){

        }
    }
</script>