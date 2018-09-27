<template>
    <div class="freezer-table">
        <button class="bluebutton" v-open-model="{ bind : 'createFreezer' }" v-on:click="createFreezer">Create new freezer</button>
        <div class="inner-freezer-table">
            <div v-for="freezer in freezers" class="freezer shadow-sm">
                <h2>{{ freezer.name }}</h2>
                <div class="toolbar">
                    <font-awesome-icon class="trash icon" icon="trash"
                                       v-on:click="deleteFreezer(freezer.id)"
                    />
                    <font-awesome-icon class="edit icon" icon="edit"
                                       v-on:click="editFreezer(freezer.id,freezer.name,freezer.description)"
                                       v-open-model="{bind: 'editfreezer'}" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import TalkerMixin from '../mixins/TalkerMixin';

    export default {

        mixins : [TalkerMixin],

        data(){
            return {
                freezers: [],
            }
        },
        methods: {
            deleteFreezer : function(id){
                var url = "organization/freezer/"+id+"/delete";
                var vm = this;
                axios.post(this.prepareURL(url)).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            },
            editFreezer : function(id,name,desc){
                this.$root.$emit('freezer_editing_open',{id : id, name : name, desc : desc}); //Throws event that we want to edit freezer with relevant data
            },
            createFreezer : function(){
                this.$root.$emit('freezer_editing_open',{id : 0, name : "", desc : ""}); //Throws event that we want to edit freezer with relevant data
            },
            fillData : function(){
                var vm = this;
                vm.freezers = [];
                axios.get(this.prepareURL("organization/freezer/list"),{}).then(function(res){
                    vm.freezers = res.data;
                }).catch(function(){

                });
            }
        },

        mounted() {
            this.fillData();
            var vm = this;

            this.$root.$on('freezer_editing_save', data => {
                var url = "organization/freezer/"+data.id+"/edit";
                axios.post(this.prepareURL(url),{
                    name : data.name,
                    description : data.desc
                }).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            });

            this.$root.$on('freezer_creating', data => {
                var url = "organization/freezer/store";
                axios.post(this.prepareURL(url),{
                    name : data.name,
                    description : data.desc
                }).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            });
        }
    }
</script>