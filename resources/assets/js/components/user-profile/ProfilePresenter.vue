<template>
    <div id="profilePresenter" class="shadow">
        <transition name="slide-fade" mode="out-in">
            <img v-bind:src="image" class="shadow" v-bind:key="image" />
        </transition>
        <h2>Patrick Hansen</h2>
        <p>Teglholmens Østkaj</p>
    </div>
</template>

<script>
    import UserMixin from '../../mixins/UserMixin'

    export default{
        mixins : [UserMixin],

        props : ['currentImage'],

        data(){
            return {
                user : this.userData(),
                image : this.currentImage,
            }
        },
        watch : {
            currentImage : function(){
                this.image = this.currentImage;
            }
        }
    }
</script>