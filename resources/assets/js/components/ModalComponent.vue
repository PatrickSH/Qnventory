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
    export default {
        data() {
            return {
                //Collecting all data on modal this is to make it dynamic.
                slotProps : {
                    category_editing_open : {
                        id : "",
                        label : "",
                        new_label : "",
                    }
                },
                image: "",
            }
        },
        props : ['customClass'],

        //Here will be a lot of different emits which this components that uses the modal dependts on
        mounted(){
            this.$root.$on('category_editing_open', data => {
                this.slotProps.category_editing_open.new_label = "";
                this.slotProps.category_editing_open.id = data.id;
                this.slotProps.category_editing_open.label = data.label;
            });
        }
    }
</script>