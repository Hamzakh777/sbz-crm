<template>
  <modal
    name="user-log-modal"
    @before-open="beforeOpen"
    :width="'90%'"
    height="auto"
    :maxWidth="600"
    :scrollable="true"
    :maxHeight="400"
    :adaptive="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" @click="$modal.hide('user-log-modal')">&times;</span>
          </button>
          <h4 class="modal-title">
            <i class="voyager-data"></i>
            <!-- {{ table.name }} -->
          </h4>
        </div>
        <div class="modal-body" style="overflow:scroll">
          <table class="table table-striped" id="log-table">
            <thead>
              <tr>
                <th>Ip Adress</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(row, index) in data.data" :key="index">
                <td>{{ row.properties.IP }}</td>
                <td>{{ row.properties.date | dateFormat }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <pagination 
            :data="data" 
            @pagination-change-page="getResults"
            :limit="4"
            :size="'small'"
          ></pagination>
        </div>
      </div>
    </div>
  </modal>
</template>

<script>
import BaseLoader from "../baseComponents/BaseLoader";
import Pagination from "laravel-vue-pagination";

export default {
  name: "UsersLogModal",

  components: {
    BaseLoader,
    Pagination
  },

  filters: {
    dateFormat(value) {
      const date = new Date(value);
      return date.getDay() 
        + '-'
        + date.getMonth()
        + '-'
        + date.getFullYear()
        + ' '
        + date.getHours()
        + ':'
        + date.getMinutes();
    }
  },

  data() {
    return {
      id: 0,
      data: {}
    }
  },

  methods: {
    beforeOpen(event) {
      // we get the id
      this.id = event.params;
      this.getResults()
    },
    getResults(page = 1) {
      const url = `users/${this.id}/log?page=${page}`;
      axios
        .get(url)
        .then(res => {
          this.data = res.data.userLog;
        })
        .catch(err => console.error(err));
    }
  }
};
</script>

<style lang="sass" scoped>
.modal-header
  background-color: #62a8ea
  color: #fff

.modal-content
  box-shadow: none

.modal-footer
  padding: 5px

.modal-dialog
  margin: auto
</style>
