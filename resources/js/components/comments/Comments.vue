<template>
    <div class="comments">
        <div :class="comments_wrapper_classes">
            <single-comment 
                v-for="comment in comments"
                :comment="comment"
                :key="comment.id"
            ></single-comment>
        </div>
        <hr>
        <div class="reply">
            <!-- <div class="avatar">
                <img :src="'https://sbz-appointment.fra1.digitaloceanspaces.com/'+current_user.avatar" alt="">
            </div> -->
            <form @submit.prevent="submitComment">
                <input 
                    type="text" 
                    v-model.trim="reply" 
                    class="reply--text" 
                    :placeholder="trans.get('voyager.generic.start_typing')"
                    maxlength="250"
                    @keyup.enter="submitComment"
                />
                <button 
                    class="reply--button" 
                    type="submit">
                    <i class="voyager-paper-plane"></i> Send
                </button>     
            </form>
        </div>
    </div>
</template>

<script>
import singleComment from './SingleComment'
    export default {
        name: 'comments',
        components: {
            singleComment
        },
        data() {
            return {
                reply: ''
            }
        },
        methods: {
            submitComment() {
                if(this.reply != '') {
                    this.$emit('submit-comment', this.reply);
                    this.reply = '';
                }
            }
        },
        props: ['comments', 'current_user', 'comments_wrapper_classes']
    }
</script>

<style scoped>
.comments {
    padding-top: 0;
}

.comments-wrapper {
    padding-right: 10px;
    max-height: 300px;
    overflow-y: scroll;
    overflow-x: visible;
}

.custom-scrollbar::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
    background-color: #fff;
}

.custom-scrollbar::-webkit-scrollbar
{
    width: 8px;
    background-color: #fff;
}

.custom-scrollbar::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    -moz-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

/* Reply component */
.reply {
    display: flex;
    position: relative;
    align-items: center;
    background-color: #f9f9f9;
    border-radius: 4px;
    padding: 5px 10px;
    overflow: hidden;
}

.reply .avatar {
    position: absolute;
}

.reply .avatar > img {
    width: 40px;
    height: 40px;
    border-radius: 100%;
}

.reply .reply--text {
    min-height: 40px;
    padding: 10px 10px 10px 10px;
    margin-right: 10px;
    border: 0;
    color: #333;
    width: 100%;
    outline: 0;
    background-color: transparent;
    box-shadow: none;
}

.reply input.reply--text:valid {
    margin-right: 71px;
}

.reply input.reply--text:valid + .reply--button {
    right: 10px;
}

.reply .reply--button {
    position: absolute;
    right: -100px;
    border: 1px solid #2ecc71;
    background-color: transparent;
    color: #2ecc71;
    opacity: 0.9;
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 30px;
    transition: color 0.25s ease-in-out, background-color 0.25s ease-in-out, border-color 0.25s ease-in-out, box-shadow 0.25s ease-in-out, right 0.25s ease-in-out;
    outline: 0;
    top: 10px;
}

.reply .reply--button:hover {
    color: #fff;
    background-color: #2ecc71;
    opacity: 1;
}

.reply .reply--button:focus,
.reply .reply--button:active {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

hr {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
