<template>
    <div class="loader">
        <div class="spinning-loader"></div>
    </div>
</template>

<script>
export default {
    name: 'BaseLoader'
}
</script>

<style lang="sass" scoped>
.loader
    position: absolute
    top: 0
    left: 0
    right: 0 
    bottom: 0
    z-index: 100
    display: flex
    justify-content: center
    align-items: center
    background-color: rgba(255,255,255,0.5)

    &::after
        background-color: transparent

    .spinning-loader 
        width: 30px
        height: 30px
        border: 5px solid rgba(29, 161, 242, 0.2)
        border-left-color: rgb(29, 161, 242)
        border-radius: 50%
        background: transparent
        animation-name: rotate-s-loader
        animation-iteration-count: infinite
        animation-duration: 1s
        animation-timing-function: linear
        position: relative
        
@keyframes rotate-s-loader 
    from 
        transform: rotate(0)
    to 
        transform: rotate(360deg)
</style>
