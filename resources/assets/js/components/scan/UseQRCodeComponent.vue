<template>
    <div class="use-code">
        <button name="submit" class="bluebutton"
                v-bind:class="{ loading: isLoading, done: isDone }"
                v-on:click.prevent="redeem">Redeem<span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <svg class="checkmark" v-bind:class="{active : isDone}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
    </div>
</template>

<script>
    import TalkerMixin from '../../mixins/TalkerMixin';
    import HelperMixin from '../../mixins/HelperMixin';

    export default {
        mixins : [HelperMixin,TalkerMixin],

        data(){
            return{
                isLoading : false,
                isDone : false,
                code_uid : this.getMetaString("code_uid"),
                org_id : this.getMetaString("org_id"),
            }
        },

        computed : {
            makeUrl : function(){
                this.url = this.prepareURL('/organization/'+ this.org_id + '/' + this.code_uid + '/');

                return this.url;
            }
        },

        methods : {
            redeem : function(){
                var vm = this;
                vm.isLoading = true;
                axios.post(this.makeUrl + 'redeem',{}).then(function(res){
                    vm.isLoading = false;
                    vm.isDone = true;
                }).catch(function(res){
                    console.log(res);
                });
            }
        },
    }
</script>