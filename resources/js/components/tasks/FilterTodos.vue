<template>
    <div>
        Filter Todos:
        <select @change="filterTodos($event)">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="200">200</option>
        </select>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: "FitlerTodos",

    methods: {
        ...mapActions(['filterTodos']),
    }
}
</script>

<style>

</style>
