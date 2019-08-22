<template>
  <div class="card">
    <div class="col-md-3">{{ task.name }}</div>
    <div class="col-md-3">{{ ownerName }}</div>
    <div class="col-md-3">{{ task.date | changeDateFormat }}</div>
    <div class="col-md-3">
      <div class="card__actions">
        <i @click="deleteTodo(index)" class="voyager-trash"></i>
      </div>
    </div>
  </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: 'TaskCard',

        props: {
            task: {
                type: Object,
                required: true
            },
            index: {
                type: Number, 
                required: true
            }
        },

        filters: {
            /**
             * Change date format to dd/mm/yyyy
             * @param {string} value
             */
            changeDateFormat(value) {
                if(value != null) {
                    const date = new Date(value);
                    console.log(date);
                    const month = parseInt(date.getMonth()) + 1; // or some absurd reason it start counting months from 0
                    const day = date.getDate();
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                } else {
                    return null;
                }
            }
        },

        computed: {
            ...mapGetters(['users']),

            ownerName() {
                if(this.task.taskOwnerId !== null && this.task.taskOwnerId !== undefined) {
                    const owner =  this.users.filter(user => user.id === this.task.taskOwnerId);

                    // filter returs an array
                    return owner[0].username;
                }
            }
        },

        methods: {
            ...mapActions('tasks',['deleteTodo'])
        },
    }
</script>

<style lang="sass" scoped>
.card
    background-color: #fff
    box-shadow: 0px 6px 20px rgba(0,0,0,0.07)
    border-left: 2px solid #4E73DF
    padding: 1.4em 0.6em 1em 0.6em
    margin-bottom: 1em
    font-size: 1em

    &__actions
        display: flex
        flex-direction: row
        justify-content: flex-end
        align-items: center

        .voyager-trash
            cursor: pointer
            display: block
            margin-top: -3px
            font-size: 20px

            &:hover
                color: #FB4027

</style>