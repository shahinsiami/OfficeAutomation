<template>
  <section>
    <div v-if="this.getData !== ''" class="container-fluid">
        <div class="row p-2 m-0 table-body w-100" v-if="this.getData !== ''">
          <div
            class="row table-row-background operation p-0 m-0 w-100"
            v-for="(item,index) in this.getData" :key="index"
          >
            <div class="col-2 d-flex flex-row h-100 align-item-center">{{index+1}}</div>
            <div class="col-8 d-flex flex-row h-100 align-item-center">
              <div>
                <a
                  class="download"
                  target="_blank"
                  :href="item.file"
                >{{item.file.split('/').pop().split('.')[0]}}</a>
              </div>
            </div>
            <div class="col-2 d-flex flex-row h-100 align-item-center">
              <div v-if="operation">
                <div v-if="operation.includes('delete')">
                  <img
                    class="btn-operator"
                    src="photo/module/Panel/forms/delete.svg"
                    width="20px"
                    height="20px"
                    @click="deleterow(item.id)"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>
</template>
<!---->
<style scoped>
.loader {
  height: 400px;
}

.download {
  color: #0095a8 !important;
}
.table-body {
  /*min-width: 800px;*/
  direction: rtl;
  font-family: IRANSans;
  font-size: 0.8em;
}

.table-row {
  height: 50px;
  align-items: center;
  border-bottom: 1px solid #ffc1e3;
}
.table-row-background:nth-child(2n) {
  background-color: #fafafa;
  transition: 0.5s ease all;
}

.table-row-background:nth-child(2n-1) {
  background-color: #eceff1;
  transition: 0.5s ease all;
}

.table-row-background:hover {
  background-color: #babdbe;
  transition: 0.5s ease all;
}

table-row-background:nth-last-child {
  border-radius: 0px 0px 10px 10px;
}

.btn-operator {
  cursor: pointer;
}
</style>
<script>
export default {
  name: "simpleDataTable",

  props: [
    "getData",
    "response",
    "operation",
    "deleteRow",
    "acceptRow",
    "rejectRow"
  ],
  data() {
    return {
      data: {}
    };
  },
  computed: {},
  methods: {
    deleterow(data) {
      if (confirm("آیا از انجام عملیات مطمئن هستید")) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " +
          (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
            ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
            : null);
        axios
          .delete(this.deleteRow + data)
          .then(response => {
            Vue.notify({
              group: "notification",
              type: response.data.type,
              title: response.data.title,
              text: Object.values(response.data.text)[0],
              duration: 10000
            });
          })
          .catch(error => {
            Vue.notify({
              group: "notification",
              type: "error",
              title: "عملیات به درستی انجام نشد",
              text: "اطلاعات ثبت نشد",
              duration: 10000
            });
          });
        setTimeout(() => {
          this.$store.dispatch(this.response[0], this.response[1]);
        }, 1500);
      } else {
        alert("اطلاعات تغییری نکرده است");
      }
    },
    accept(data) {
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      axios
        .post(this.acceptRow + data)
        .then(response => {
          Vue.notify({
            group: "notification",
            type: response.data.type,
            title: response.data.title,
            text: Object.values(response.data.text)[0][0],
            duration: 10000
          });
        })
        .catch(error => {
          Vue.notify({
            group: "notification",
            type: "error",
            title: "عملیات به درستی انجام نشد",
            text: "اطلاعات ثبت نشد",
            duration: 10000
          });
        });
      setTimeout(() => {
        this.$store.dispatch(this.response);
      }, 1500);
    },
    reject(data) {
      axios.defaults.headers.common["Authorization"] =
        "Bearer " +
        (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
          ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
          : null);
      axios
        .post(this.rejectRow + data)
        .then(response => {
          Vue.notify({
            group: "notification",
            type: response.data.type,
            title: response.data.title,
            text: Object.values(response.data.text)[0][0],
            duration: 10000
          });
        })
        .catch(error => {
          Vue.notify({
            group: "notification",
            type: "error",
            title: "عملیات به درستی انجام نشد",
            text: "اطلاعات ثبت نشد",
            duration: 10000
          });
        });
      setTimeout(() => {
        this.$store.dispatch(this.response);
      }, 1500);
    },
    selectColumn(e) {
      document.querySelectorAll(".search-select-column").forEach(item => {
        item.classList.remove("select-column");
      });
      e.target.classList.add("select-column");
      this.data.searchColumn = e.target.getAttribute("search-select");
    }
  },
  created() {}
};
</script>
