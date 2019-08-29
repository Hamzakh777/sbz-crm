<template>
  <div id="comments">
    <div class="panel panel-primary panel-bordered">
      <div class="comments-header">
        <div class="comments-stats">
          <span>
            <i class="voyager-bubble"></i>
            {{ comments.length }}
          </span>
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
import Comments from "./comments.vue";
import BaseLoader from '../baseComponents/BaseLoader';
import {mapGetters} from 'vuex';

export default {
  name: "commentsPanel",

  components: {
    Comments
  },

  watch: {
    'salesOrder.comments': function(newVal, oldVal) {
      this.comments = newVal;
    }
  },
  
  computed: {
    ...mapGetters(['salesOrder'])
  },

  data() {
    return {
      creator: {},
      current_user: {},
      comments: [],
    };
  },

  methods: {
    submitComment(reply) {
      axios
        .post('/api/comments/', {
          body: reply,
          salesOrderId: this.salesOrder.id
        })
        .then(response => {
          this.comments.push(response.data.comment);
        });

      // const response = await axios.post('/api/comments/', {
      //   body: reply,
      //   salesOrderId: this.salesOrder.id
      // }); 
    }
  },

  created() {
    // we are going to get the comments form the salesorder since they 
    // will be eager loaded with it
    this.comments = this.salesOrder.comments;
  },
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
  background-color: #f8f9fc;
  padding: 10px;
  align-items: center;
  display: flex;
  justify-content: space-between;
  color: #4e73df;
  min-height: 60px;
  font-size: 20px;
  border-bottom: 1px solid #e3e6f0;
}

.comments-header .comments-stats span {
  margin-left: 10px;
  font-size: 18px;
  font-weight: 500;
}

hr {
  margin-top: 10px;
  margin-bottom: 10px;
  padding: 0px 20px;
}
</style>
