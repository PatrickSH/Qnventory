<template>
    <div class="items-table">
        <button class="bluebutton" v-open-model="{ bind : 'createItem' }" v-on:click="createItem">Create new item</button>
        <div class="inner-item-table">
            <transition-group tag="div" name="list-complete">
                <div v-for="item in item_list" class="item shadow-sm list-item" v-bind:key="item.item.id">
                    <h2>{{ (item.item.label == "" ? 'No label available' : item.item.label) }}</h2>
                    <div class="toolbar">
                        <font-awesome-icon class="trash icon" icon="trash"
                                           v-on:click="deleteItem(item.freezer_item_id)"
                        />
                        <font-awesome-icon class="edit icon" icon="edit"
                                           v-on:click="editItem(item.item)"
                                           v-open-model="{bind: 'edititem'}" />
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
</template>
<script>
    import TalkerMixin from '../mixins/TalkerMixin';

    export default {

        mixins : [TalkerMixin],

        data(){
            return {
                item_list: [],
            }
        },
        methods: {
            deleteItem : function(id){
                var url = "organization/item/"+id+"/delete";
                var vm = this;
                axios.post(this.prepareURL(url)).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            },
            editItem : function(item){
                this.$root.$emit('item_editing_open',
                    {
                        id : item.id,
                        label : item.label,
                        category : item.category_id,
                        weight : item.weight,
                        freezer : item.freezer_id,
                        expires : item.expires,
                        bought : item.bought,
                        cats : this.getCats(),
                        freezers : this.getFreezers(),
                    }
                    ); //Throws event that we want to edit item with relevant data
            },
            createItem : function(){
                this.$root.$emit('item_editing_open',{
                    id : "",
                    label : "",
                    category : "",
                    weight : "",
                    freezer : "",
                    expires : "",
                    bought : "",
                    cats : this.getCats(),
                    freezers : this.getFreezers(),
                }); //Throws event that we want to edit item with relevant data
            },

            /**
             * Returns promise
             */
            getCats : function(){
                return axios.get(this.prepareURL('organization/category/list'),{}).then(function(response){
                  return response.data;
                });
            },

            getFreezers : function(){
                return axios.get(this.prepareURL('organization/freezer/list'),{}).then(function(response){
                    return response.data;
                });
            },

            fillData : function(){
                var vm = this;
                vm.item_list = [];
                axios.get(this.prepareURL("organization/item/list"),{}).then(function(res){
                    vm.item_list = res.data;
                }).catch(function(){

                });
            }
        },

        mounted() {
            this.fillData();
            var vm = this;
            this.$root.$on('item_editing_save', data => {
                console.log(data);
                var url = "organization/item/"+data.id+"/edit";
                axios.post(this.prepareURL(url),{
                    id : data.id,
                    label : data.label,
                    weight : data.weight,
                    bought : data.bought,
                    expires : data.expires,
                    category : data.category,
                    freezer : data.freezer,
                }).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            });

            this.$root.$on('item_creating', data => {
                var url = "organization/item/store";
                axios.post(this.prepareURL(url),{
                    label : data.label,
                    weight : data.weight,
                    bought : data.bought,
                    expires : data.expires,
                    category : data.category,
                    freezer : data.freezer,
                }).then(function(){
                    vm.fillData();
                }).catch(function(){

                });
            });
        }
    }
</script>