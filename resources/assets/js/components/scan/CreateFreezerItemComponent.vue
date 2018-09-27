<template>
    <div class="newFreezerItem">
        <div class="input-groups">
            <div class="group select">
                <select name="category" v-model="postData.category" required>
                    <option v-for="cat in cats" v-bind:value="cat.id">{{ cat.label }}</option>
                </select>
                <label class="label-floating">Item category *</label>
            </div>
            <div class="group select">
                <select name="selected_freezer" v-model="postData.selected_freezer" required>
                    <option v-for="freezer in freezers" v-bind:value="freezer.id">{{ freezer.name }}</option>
                </select>
                <label class="label-floating">Item category *</label>
            </div>
            <div class="group">
                <input type="text" class="input_field float-input-label" v-model="postData.label" placeholder=" "/>
                <label class="label-floating">Label</label>
            </div>
            <div class="group">
                <input type="text" class="input_field float-input-label" v-model="postData.weight" placeholder=" "/>
                <label class="label-floating">Weight</label>
            </div>
            <div class="group vue-date">
                <v-date-picker v-model="postData.bought" :mode="mode" :attributes="calendarAttrs"></v-date-picker>
                <label class="label-floating">Bought</label>
            </div>
            <div class="group vue-date">
                <v-date-picker v-model="postData.expires" :mode="mode" :attributes="calendarAttrs"></v-date-picker>
                <label class="label-floating">Expires</label>
            </div>
        </div>
        <div class="button_in_line">
            <button name="submit" class="bluebutton"
                    v-bind:class="{ loading: isLoading, done: isDone }"
                    v-on:click.prevent="save">Save<span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <svg class="checkmark" v-bind:class="{active : isDone}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
        </div>
    </div>
</template>

<script>
    import HelperMixin from '../../mixins/HelperMixin';
    import TalkerMixin from '../../mixins/TalkerMixin';
    import VCalendar from 'v-calendar';
    import 'v-calendar/lib/v-calendar.min.css';

    export default {

        components : {
            VCalendar
        },

        mixins : [HelperMixin,TalkerMixin],

        data(){
            return {
                isLoading : false,
                isDone : false,
                postData : {
                    expires : new Date(),
                    bought : new Date(),
                    label : "",
                    weight : "",
                    category : "",
                    selected_freezer : "",
                    freezer_name : "",
                    cat_label : "",
                },
                freezers : [],
                cats : [],
                mode : 'single',
                code_uid : this.getMetaString("code_uid"),
                org_id : this.getMetaString("org_id"),
                url : "",
                calendarAttrs: [
                    {
                        key: 'today',
                        highlight: {
                            backgroundColor: '#7385ED',
                            height: '80px',
                            paneWidth: "80px",
                            // Other properties are available too, like `height` & `borderRadius`
                        },
                        dates: new Date(2018, 0, 1)
                    }
                ],
            }
        },

        computed : {
            makeUrl : function(){
                this.url = this.prepareURL('/organization/'+ this.org_id + '/' + this.code_uid + '/');

                return this.url;
            }
        },

        methods : {
            save : function(){
                var vm = this;
                vm.isLoading = true;
                axios.post(this.makeUrl + 'store',vm.postData).then(function(res){
                    vm.isLoading = false;
                    vm.isDone
                }).catch(function(res){
                   console.log(res);
                });
            }
        },

        mounted(){
          var vm = this;
          axios.get(this.makeUrl +'list-cats',{

          }).then(function(response){
              vm.postData.category = response.data[0].id;
              vm.cats = response.data;
              vm.cats.push({ id : "new", label : "Create new category"});
          });

            axios.get(this.makeUrl + 'list-freezers',{

            }).then(function(response){
                vm.postData.selected_freezer = response.data[0].id;
                vm.freezers = response.data;
                vm.freezers.push({ id : "new", name : "Create new freezer"});
            });
        },

        watch: {
            'postData.category' : function(val, oldVal){
                if(oldVal != "" && val == "new"){
                    var label = prompt("New category name");
                    this.postData.cat_label = label;
                }
            },
            'postData.selected_freezer' : function(val, oldVal){
                if(oldVal != "" && val == "new"){
                    var label = prompt("New freezer name");
                    this.postData.freezer_name = label;
                }
            },
        }

    }
</script>