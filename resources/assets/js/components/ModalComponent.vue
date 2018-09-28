<template>
    <div class="modal" v-bind:class="customClass">
        <div class="overlay"></div>
        <div class="innerModal">
            <slot name="title" :slotprops="slotProps"></slot>
            <div class="content">
                <slot name="content" :slotprops="slotProps"></slot>
                <slot name="buttons" :slotprops="slotProps"></slot>
            </div>
        </div>
    </div>
</template>
<script>
    import VCalendar from 'v-calendar';
    import 'v-calendar/lib/v-calendar.min.css';

    export default {

        components : {
            VCalendar
        },

        data() {
            return {
                //Collecting all data on modal this is to make it dynamic.
                slotProps : {
                    global : {
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
                    },
                    category_editing_open : {
                        id : "",
                        label : "",
                        new_label : "",
                    },
                    freezer_editing_open : {
                        id : "",
                        name : "",
                        desc : "",
                    },
                    item_editing_open : {
                        id : "",
                        label : "",
                        weight : "",
                        expires : new Date(),
                        bought : new Date(),
                        cats : [],
                        freezers : [],
                        category : "",
                        freezer : "",
                    }
                },
                image: "",
            }
        },
        props : ['customClass'],

        //Here will be a lot of different emits which this components that uses the modal dependts on
        mounted(){
            //Category
            this.$root.$on('category_editing_open', data => {
                this.slotProps.category_editing_open.new_label = "";
                this.slotProps.category_editing_open.id = data.id;
                this.slotProps.category_editing_open.label = data.label;
            });

            //Freezer
            this.$root.$on('freezer_editing_open', data => {
                this.slotProps.freezer_editing_open.name = "";
                this.slotProps.freezer_editing_open.desc = "";
                this.slotProps.freezer_editing_open.id = data.id;
                this.slotProps.freezer_editing_open.desc = data.desc;
                this.slotProps.freezer_editing_open.name = data.name;
            });

            //Item
            this.$root.$on('item_editing_open', data => {
                var vm = this.slotProps.item_editing_open;
                this.slotProps.item_editing_open.label = "";
                this.slotProps.item_editing_open.weight = "";
                this.slotProps.item_editing_open.category = "";
                this.slotProps.item_editing_open.freezer = "";
                this.slotProps.item_editing_open.expires = [];
                this.slotProps.item_editing_open.bought = [];
                this.slotProps.item_editing_open.id = data.id;
                this.slotProps.item_editing_open.label = data.label;
                this.slotProps.item_editing_open.weight = data.weight;
                this.slotProps.item_editing_open.category = data.category;
                this.slotProps.item_editing_open.freezer = data.freezer;
                this.slotProps.item_editing_open.expires = new Date(data.expires);
                this.slotProps.item_editing_open.bought = new Date(data.bought);
                data.cats.then(data => { //Data from axios promise
                    vm.cats.push(data);
                });

                data.freezers.then(data => { //Data from axios promise
                    vm.freezers.push(data);
                });

            });
        }
    }
</script>