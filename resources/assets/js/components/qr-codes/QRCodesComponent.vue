<template>
    <div id="code-overview">
        <button class="bluebutton" v-open-model="{ bind : 'requestnewqrmodel' }">Request new codes</button>
        <div class="codes">
            <div v-for="code in codes" class="code shadow-sm" v-bind:style="{ backgroundImage: 'url(' + code.path + ')' }"/>
        </div>
    </div>
</template>
<script>
    import TalkerMixin from '../../mixins/TalkerMixin';

    export default {
        mixins : [TalkerMixin],

        data(){
            return {
                codes : "",
            }
        },

        mounted(){
            var vm = this;
            axios.get(this.prepareURL("qrcodes/list"),{

            }).then(function(response){
               vm.codes = response.data;
            }).catch(function(error){

            });

        }

    }
</script>