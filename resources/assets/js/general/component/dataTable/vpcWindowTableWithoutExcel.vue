<template>
  <section>
         <!-- notify -->
    <div v-if="this.showNotify">
   <div @click="closeNotify"   class="vpc_notify_container_background">
   </div>
    <div class="vpc_notify_container">
        <div class="vpc_notify">
          <div class="d-flex flex-row w-100 vpc_notify_title">{{this.title}}</div>
          <div class="d-flex flex-row w-100 vpc_notify_error">{{this.message}}</div>
          <div class="d-flex flex-row justify-content-center align-items-center vpc_notify_icon_holder">
            <img @click="closeNotify" class="vpc_notify_icon" v-if="this.type == 'success'" src="photo/module/Panel/forms/accept.png">
            <img @click="closeNotify" class="vpc_notify_icon" v-if="this.type == 'error'" src="photo/module/Panel/forms/reject.png">
          </div>
        </div>
    </div>
    </div>
    <!-- notify -->
    <div v-if="tableInfo == ''" class="vpc_loader">
    <div class="vpc_loader_img">
       <img width="300" height="300" src="photo/module/Panel/forms/loader.gif" />
       </div>
    </div>
    <!--  -->
    <div v-if="tableInfo !== ''">
      <div class="row vpc_table_header p-3" v-if="this.tableInfo.data !== ''">
        <div class="my-2 col-12 col-lg-6">
          <div class="vpc_input_holder">
            <span class="w-100">
              <input
                @keyup="dataSearch"
                v-model="data.searchName"
                placeholder="جستجو"
                type="text"
                class="vpc_input"
              />
              <label>جستجو</label>
            </span>
          </div>
        </div>
        <!--  -->
        <div class="my-2 col-12 col-lg-6 d-flex flex-row justify-content-center align-items-center">
          <div class="vpc_search_title mx-1">جستجو بر اساس ستون</div>
          <div v-for="(searchItem,index) in tableColumn" :key="index">
            <div
              v-bind:class="[index === 0  ? 'vpc_search_title_object_active' : '']"
              v-if="searchItem.searchable === 'true'"
              class="vpc_search_title_object"
              :search-select="searchItem.title"
              @click="selectColumn($event)"
            >{{searchItem.headerTitle}}</div>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <div class="p-3 text-center">
      <div class="d-flex flex-row my-2 align-items-center vpc_datatable_date w-100">
        <div class="mx-2">از تاریخ</div>
        <date-picker
          format="jYYYY-jMM-jDD HH:mm:ss"
          @change="changeStartDate"
          color="#9E9E9E"
          type="datetime"
        ></date-picker>
        <div class="mx-2">تا تاریخ</div>
        <date-picker
          format="jYYYY-jMM-jDD HH:mm:ss"
          @change="changeEndDate"
          color="#9E9E9E"
          type="datetime"
        ></date-picker>
      </div>
      <!-- header -->
      <div
        v-if="this.tableColumn !== ''"
        class="row vpc_table_direction justify-content-center align-items-center p-0 m-0 my-3"
      >
        <div
          v-for="(columnHeader,index) in tableColumn"
          :key="index"
          :class="columnHeader.col"
          class="vpe_table_header"
        >
          <!---->
          <span v-if="columnHeader.headerType === 'headerOrder'">
            <div class="d-flex flex-row justify-content-center align-items-center flex-nowrap">
              <div>
                <img
                  @click="changeOrder(columnHeader.title,'ASC')"
                  class="ascdsc"
                  src="photo/module/Panel/forms/asc.svg"
                  width="10px"
                  height="10px"
                />
              </div>
              <div>
                <img
                  @click="changeOrder(columnHeader.title,'DESC')"
                  class="ascdsc"
                  src="photo/module/Panel/forms/dsc.svg"
                  width="10px"
                  height="10px"
                />
              </div>
              <div class="headerTitle">{{columnHeader.headerTitle}}</div>
            </div>
          </span>
          <!---->
          <span v-if="columnHeader.headerType === 'headerTitle'">{{columnHeader.headerTitle}}</span>
          <!---->
          <span v-if="columnHeader.headerType === 'headerOperation'">عملیات</span>
          <!---->
        </div>
      </div>
      <!-- header -->
      <!-- body -->
      <div v-if="this.tableColumn !== ''">
        <div
          class="row vpc_table_row justify-content-center align-items-center p-0 m-0"
          v-for="(item,rowIndex) in this.tableInfo.data"
          :key="rowIndex"
        >
          <div
            v-for="(columnItem,index) in tableColumn"
            :key="index"
            :class="columnItem.col"
            class="vpc_table_column"
          >
            <!-- number -->
            <p class="h-100" v-if="columnItem.type === 'number'">{{ rowIndex+1 }}</p>
            <!-- number -->
            <!-- date -->
            <p class="h-100" v-if="columnItem.type === 'date'">
              <span v-html="momentDate(item[columnItem.title])"></span>
            </p>
            <!-- date -->
            <!-- string -->
            <p v-if="columnItem.type === 'string'">{{item[columnItem.title]}}</p>
            <!-- string -->
            <!-- substring -->
            <p v-if="columnItem.type === 'substring'">
              <span
                v-if="item[columnItem.title].lenght > 1"
              >{{item[columnItem.title].substring(0,25)}}.....</span>
            </p>
            <!-- substring -->
            <!-- image -->
            <div v-if="columnItem.type === 'img'">
              <img
                v-if="item[columnItem.title]"
                :src="item[columnItem.title]"
                @click="zoomimage($event)"
                class="vpc_dataTable_image"
              />
            </div>
            <!-- image -->
            <!-- relation -->
            <p v-if="columnItem.type === 'relation'">{{item[columnItem.title][columnItem.relation]}}</p>
            <!-- relation -->
            <!-- manyRelation -->
            <p v-if="columnItem.type === 'manyRelation'">
              <span
                v-for="(manyrelation,index) in item[columnItem.title]"
                :key="index"
              >{{manyrelation.name}},</span>
            </p>
            <!-- manyRelation -->
            <!-- manyRelationObject -->
            <p v-if="columnItem.type === 'manyRelationObject'">
              <span
                v-for="(manyrelation,index) in item[columnItem.title][columnItem.relationTitle]"
                :key="index"
              >{{manyrelation.name}}</span>
            </p>
            <!-- manyRelationObject -->
            <!-- manyRelationObjectWithTwoTitle -->
            <p v-if="columnItem.type === 'manyRelationObjectWithTwoTitle'">
              <span v-for="(manyrelation,index) in item[columnItem.title]" :key="index">
                {{manyrelation[columnItem.relationTitle][columnItem.relationSubTitleOne]}}
                <span
                  v-if="columnItem.relationSubTitleTwo"
                >{{manyrelation[columnItem.relationTitle][columnItem.relationSubTitleTwo]}}</span>
              </span>
            </p>
            <!-- manyRelationObjectWithTwoTitle -->
            <!-- manyRelationSingleObject -->
            <p
              v-if="columnItem.type === 'manyRelationSingleObject'"
            >{{item[columnItem.title][columnItem.relationTitle][columnItem.relation]}}</p>
            <!-- manyRelationSingleObject -->
            <!-- operation -->
            <!-- operation -->
            <!-- operation -->
            <p v-if="columnItem.type === 'operatoin'">
              <span>
                <img
                  class="img-fluid mx-1"
                  src="photo/module/Panel/forms/delete.svg"
                  width="20px"
                  height="20px"
                  @click="deleterow(item[firstColumnSearch])"
                />
              </span>
              <span>
                <img
                  class="img-fluid mx-1"
                  src="photo/module/Panel/forms/edit.svg"
                  width="20px"
                  height="20px"
                  @click="editrow(item[firstColumnSearch])"
                />
              </span>
            </p>
            <p v-if="columnItem.type === 'operatoinWithoutDelete'">
              <span>
                <img
                  class="img-fluid"
                  src="photo/module/Panel/forms/edit.svg"
                  width="20px"
                  height="20px"
                  @click="editrow(item[firstColumnSearch])"
                />
              </span>
            </p>
            <p v-if="columnItem.type === 'acceptAndReject'">
              <span>
                <img
                  class="img-fluid"
                  src="photo/module/Panel/forms/accept.png"
                  width="20px"
                  height="20px"
                  @click="accept(item[firstColumnSearch])"
                />
              </span>
              <span>
                <img
                  class="img-fluid"
                  src="photo/module/Panel/forms/reject.png"
                  width="20px"
                  height="20px"
                  @click="reject(item[firstColumnSearch])"
                />
              </span>
            </p>
            <p v-if="columnItem.type === 'operatoinWithoutEdit'">
              <span>
                <img
                  class="img-fluid"
                  src="photo/module/Panel/forms/delete.svg"
                  width="20px"
                  height="20px"
                  @click="deleterow(item[firstColumnSearch])"
                />
              </span>
            </p>
            <p v-if="columnItem.type === 'view'">
              <span>
                <img
                  class="img-fluid"
                  src="photo/module/Panel/forms/view.svg"
                  width="30px"
                  height="30px"
                  @click="editrow(item[firstColumnSearch])"
                />
              </span>
            </p>
            <!-- operation -->
          </div>
        </div>
      </div>
      <!-- body -->
      <!------------------------------------------------------------------------->
      <div
        class="p-0 d-flex flex-row justify-content-around align-items-center vpc_table_paginate w-100"
        v-if="this.tableInfo !== '' && this.data.render"
      >
        <div
          class="d-flex flex-row justify-content-center align-items-center"
          v-if="this.tableInfo.last_page > 1"
        >
          <div v-for="(item,index) in this.tableInfo.last_page" :key="index">
            <div
              v-bind:class="[index === 0  ? 'vpc_table_paginate_object_active' : '']"
              class="vpc_table_paginate_object px-2"
              @click="changePage(index,$event)"
            >{{index+1}}</div>
          </div>
        </div>
        <div class="vpc_table_paginate_object">صفحه</div>
      </div>
    </div>
  </section>
</template>
<!---->

<style lang="scss" scoped>
::-webkit-scrollbar {
  width: 3px;
  height: 3px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb:hover {
  background: #bdbdbd;
}
</style>
<script>
import VuePersianDatetimePicker from "vue-persian-datetime-picker";

var moment = require("moment-jalaali");
export default {
  name: "windowTable",
  components: { datePicker: VuePersianDatetimePicker },
  props: [
    "getData",
    "firstColumnSearch",
    "selectStore",
    "excel",
    "fileName",
    "selectRow",
    "deleteRow",
    "openSelectRow",
    "tableColumn",
    "acceptRow",
    "rejectRow",
  ],
  data() {
    return {
         notifyAnimation: new this.$root.$data.gsapVpc.timeline(),
      notifyIconAnimation: new this.$root.$data.gsapVpc.timeline(),
      showNotify: false,
      time: "",
      data: {
        name: this.firstColumnSearch,
        order: "ASC",
        searchName: "",
        searchColumn: this.firstColumnSearch,
        pageNum: 0,
        render: true,
        startDate: "1970-03-21 00:00:00",
        endDate: "2070-03-21 00:00:00",
      },
    };
  },
  computed: {
    tableInfo: {
      get() {
        if (this.$store.state[this.selectStore][this.getData]) {
          return this.$store.state[this.selectStore][this.getData];
        }
        return "";
      },
    },
  },
  methods: {
    zoomimage(e) {
      e.target.classList.toggle("zoom-image");
    },
    momentDate(item) {
      if (item !== null) {
        let tempDate = moment(item, "YYYY-MM-DD HH:mm:ss").format(
          "jYYYY-jMM-jDD"
        );
        let tempTime = moment(item, "YYYY-MM-DD HH:mm:ss").format(" HH:mm:ss");
        let template =
          '<div class="d-flex flex-row justify-content-center align-items-center w-100 h-100">' +
          '<div class="d-flex flex-column">' +
          '<div style=" color:#12005e;">' +
          tempDate +
          "</div>" +
          '<div style="color:#7c43bd;">' +
          tempTime +
          "</div>" +
          "</div>" +
          "</div>";
        return template;
      } else {
        return "";
      }
    },
    changeStartDate(e) {
      let startDate = new Date(e);
      this.data.startDate = moment(startDate).format("YYYY-MM-DD hh:mm:ss");
      this.$store.dispatch(this.getData, this.data);
    },
    changeEndDate(e) {
      let endDate = new Date(e);
      this.data.endDate = moment(endDate).format("YYYY-MM-DD hh:mm:ss");
      this.$store.dispatch(this.getData, this.data);
    },
    changePage(pageNum, e) {
      document
        .querySelectorAll(".vpc_table_paginate_object")
        .forEach((item) => {
          item.classList.remove("vpc_table_paginate_object_active");
        });
      e.target.classList.add("vpc_table_paginate_object_active");
      this.data.pageNum = pageNum;
      this.$store.dispatch(this.getData, this.data);
    },
    changeOrder(name, order) {
      this.data.pageNum = 0;
      this.data.order = order;
      this.data.name = name;
      this.$store.dispatch(this.getData, this.data);
      $(".pagination").removeClass(".paginationactive");
    },
    dataSearch() {
      this.data.pageNum = 0;
      clearTimeout(this.time);
      let searchInterrupt = setTimeout(() => {
        this.$store.dispatch(this.getData, this.data);
      }, 800);
      this.time = searchInterrupt;
    },
    editrow(data) {
      this.$store.state[this.selectStore][this.selectRow] = { id: "" };
      document.location = `/${this.openSelectRow[0]}#/${this.openSelectRow[1]}`;
      let tab = { name: this.openSelectRow[2], route: this.openSelectRow[1] };
      this.$store.dispatch("upSidePush", tab);
      setTimeout(() => {
        this.$store.dispatch(this.selectRow, data);
      }, 1000);
    },
    deleterow(data) {
      if (confirm("آیا از انجام عملیات مطمئن هستید")) {
        axios.defaults.headers.common["Authorization"] =
          "Bearer " +
          (document.cookie.match("(^|;) ?token=([^;]*)(;|$)")
            ? document.cookie.match("(^|;) ?token=([^;]*)(;|$)")[2]
            : null);
        axios
          .delete(this.deleteRow + data)
          .then((response) => {
           
          })
          .catch((error) => {
            
          });
        setTimeout(() => {
          this.$store.dispatch(this.getData, this.data);
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
        .then((response) => {
        this.showNotify = true;
          this.title = 'تایید'
          this.message = 'این ردیف تایید شد'
          this.type = 'success'
        setTimeout(() => {
          this.notifyAnimation.to(".vpc_notify", 0.5, {
            width: 400,
          });
              this.notifyIconAnimation.to(".vpc_notify_icon", 1, {
            scale: 1,
          });
        }, 100);
        })
        .catch((error) => {
          
        });
      setTimeout(() => {
        this.$store.dispatch(this.getData, this.data);
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
        .then((response) => {
          this.showNotify = true;
          this.title = 'عدم تایید'
          this.message = 'این ردیف تایید نشد'
          this.type = 'error'
        setTimeout(() => {
          this.notifyAnimation.to(".vpc_notify", 0.5, {
            width: 400,
          });
              this.notifyIconAnimation.to(".vpc_notify_icon", 1, {
            scale: 1,
          });
        }, 100);
        })
        .catch((error) => {
         
        });
      setTimeout(() => {
        this.$store.dispatch(this.getData, this.data);
      }, 1500);
    },
    selectColumn(e) {
      document.querySelectorAll(".vpc_search_title_object").forEach((item) => {
        item.classList.remove("vpc_search_title_object_active");
      });
      e.target.classList.add("vpc_search_title_object_active");
      this.data.searchColumn = e.target.getAttribute("search-select");
    },
        closeNotify(){
      this.showNotify = false;
    },
  },
  created() {
    this.$store.dispatch(this.getData, this.data);
  },
};
</script>
