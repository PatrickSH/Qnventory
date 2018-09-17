<template>
    <div id="firstlogin">
        <form method="post" name="userDataForm">
            <div class="input-groups">
                <div class="group radios">
                    <input type="radio" name="gender" value="f"/>
                    <label>Male</label>
                    <input type="radio" name="gender" value="m"/>
                    <label>Female</label>
                </div>
                <div class="group image">
                    <label>Show people how you look!</label>
                    <input type="file" class="input_field" v-on:change="onFileChange" name="image" />
                </div>
            </div>
            <!--<div class="button_in_line">
                <button
                    name="submit">Login<span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span></button>
            </div>-->
        </form>
    </div>
</template>
<script>
    import TalkerMixin from '../mixins/TalkerMixin';
    export default {
        data() {
            return {
                image : ""
            }
        },

        mixins: [TalkerMixin],

        methods : {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;
                this.createImage(files[0]);
                axios.post(this.prepareURL('user/save-meta'), {
                    image : this.image
                }).then(function (response) {
                }).catch(function (error) {
                });
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },

        computed: {
        }
    }
</script>
