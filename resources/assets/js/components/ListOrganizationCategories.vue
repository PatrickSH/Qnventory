<template>
    <div class="category-table">
        <button class="bluebutton" v-open-model="{ bind : 'createCategory' }">Create new category</button>
        <div class="inner-category-table">
            <div v-for="cat in cats" class="category shadow-sm">
                <h2>{{ cat.label }}</h2>
                <p>{{ cat.items_count }}</p>
                <div class="toolbar">
                    <font-awesome-icon class="trash icon" icon="trash"
                                       v-on:click="deleteCat(cat.id,cat.label)"
                                        />
                    <font-awesome-icon class="edit icon" icon="edit"
                                       v-on:click="editCat(cat.id,cat.label)"
                                       v-open-model="{bind: 'editcategory'}" />
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
                cats: [],
            }
        },
        methods: {
            deleteCat : function(id){
                var url = "organization/category/"+id+"/delete";
                var vm = this;
                axios.post(this.prepareURL(url)).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            },
            editCat : function(id,label){
                this.$root.$emit('category_editing_open',{id : id, label : label}); //Throws event that we want to edit cat with relevant data
            },
            fillData : function(){
                var vm = this;
                vm.cats = [];
                axios.get(this.prepareURL("organization/category/list"),{}).then(function(res){
                    vm.cats = res.data;
                }).catch(function(){

                });
            }
        },

        mounted() {
            this.fillData();
            var vm = this;

            this.$root.$on('category_editing_save', data => {
                var url = "organization/category/"+data.id+"/edit";
                axios.post(this.prepareURL(url),{
                    label : data.value
                }).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            });

            this.$root.$on('category_creating', data => {
                var url = "organization/category/store";
                axios.post(this.prepareURL(url),{
                    label : data.value
                }).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            });
        }
    }
</script>