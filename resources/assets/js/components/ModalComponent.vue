<template>
    <div class="modal">
        <div class="overlay"></div>
        <div class="innerModal">
            <slot name="title"></slot>
            <div class="content">
                <slot name="content"></slot>
                <slot name="buttons"></slot>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                image: ""
            }
        },
        props : []
    }
</script>