<template>
  <div id="comments">
    <div class="comments-outside panel panel-primary panel-bordered">
      <div class="comments-header">
        <div class="comments-stats">
          <span>
            <i class="voyager-bubble"></i>
            {{ comments.length }}
          </span>
        </div>
        <div class="post-owner">
          <div class="avatar">
            <img :src="creator.avatar" alt />
          </div>
          <div class="username">
            <a href="#">@{{ creator.user_name }}</a>
          </div>
        </div>
      </div>
      <div class="panel-body">      
        <comments
          :comments_wrapper_classes="['custom-scrollbar', 'comments-wrapper']"
          :comments="comments"
          :current_user="current_user"
          @submit-comment="submitComment"
        ></comments>
      </div>
    </div>
  </div>
</template>

<script>
import Comments from "./Comments.vue";

export default {
  name: "commentsSection",

  components: {
    Comments
  },

  props: {
    appointmentId: {
      type: Number,
      required: true
    }
  },

  created() {
    axios
      .post("/comments", {
        id: this.appointmentId
      })
      .then(response => {
        const data = response.data;
        this.comments = data.comments;
        this.current_user = data.current_user;
        this.creator = data.creator;
        this.comments = _.merge(data.previousAppointmentComments, this.comments);
        // this.comments.unshift(data.previousAppointmentComments);
      });
  },

  data() {
    return {
      likes: 15,
      creator: {},
      current_user: {},
      comments: [],
    };
  },
  methods: {
    submitComment(reply) {
      axios
        .post("/comments/" + this.appointmentId, {
          body: reply,
          appointmentId: this.appointmentId
        })
        .then(response => {
          this.comments.push(response.data.comment);
        });
    }
  }
};
</script>

<style>
#comments {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

a {
  text-decoration: none;
}

hr {
  display: block;
  height: 1px;
  border: 0;
  border-top: 1px solid #ececec;
  margin: 1em 0;
  padding: 0;
}

.comments-outside {
  box-shadow: 0 2px 30px rgba(0, 0, 0, 0.12);
  margin: 0 auto !important;
  max-width: 100%;
}

.comments-header {
  background-color: #fcfcfc;
  padding: 10px;
  align-items: center;
  display: flex;
  justify-content: space-between;
  color: #333;
  min-height: 70px;
  font-size: 20px;
}

.comments-header .comments-stats span {
  margin-left: 10px;
  font-size: 18px;
  font-weight: 500;
}

.post-owner {
  display: flex;
  align-items: center;
}

.post-owner .avatar > img {
  width: 30px;
  height: 30px;
  border-radius: 100%;
}

.post-owner .username {
  margin-left: 5px;
}

.post-owner .username > a {
  color: #76838f;
  font-size: 16px;
  font-weight: 500;
  margin-right: 8px;
}

hr {
  margin-top: 10px;
  margin-bottom: 10px;
  padding: 0px 20px;
}
</style>
