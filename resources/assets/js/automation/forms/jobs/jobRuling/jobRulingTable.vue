<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center"></div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
    <windowTable
      :selectStore="this.table.selectStore"
      :getData="this.table.getData"
      :excel="this.table.excel"
      :tableColumn="this.table.column"
      :fileName="this.table.fileNmae"
      :selectRow="this.table.selectRow"
      :openSelectRow="this.table.openSelectRow"
      :deleteRow="this.table.deleteRow"
      firstColumnSearch="id"
    ></windowTable>
  </div>
</template>
<style scoped>
</style>
<script>
export default {
  name: "jobRulingTable",
  data() {
    return {
      window: {
        headerid: "jobRulingTable",
        title: "حکم های کارگزینی",
        titleLine: "منابع انسانی / کارگزینی / حکم کارگزینی",
      },
      table: {
        selectStore: "jobStore",
        getData: "jobRulingTable",
        openSelectRow: ["automation", "jobRulingEdit", "حکم های کازگزینی"],
        selectRow: "selectjobRulingEdit",
        deleteRow: "/api/v1/deletejobRuling/",
        excel: "",
        fileNmae: "",
        column: [
          {
            title: "id",
            type: "number",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "شماره",
            searchable: "true",
          },
          {
            title: "user",
            relationTitle: "userinfo",
            relation: "family",
            type: "manyRelationSingleObject",
            headerType: "headerTitle",
            headerTitle: "نام خانوادگی",
            col: "col-2",
          },
          {
            title: "user",
            relationTitle: "user_job_position",
            relation: "name",
            type: "manyRelationObject",
            headerType: "headerTitle",
            headerTitle: "گروه شغلی",
            col: "col-2",
          },
          {
            title: "start_date",
            type: "date",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "تاریخ شروع",
            searchable: "true",
          },
          {
            title: "end_date",
            type: "date",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "تاریخ پایان" + "",
            searchable: "true",
          },
          {
            title: "operation",
            type: "operatoin",
            headerType: "headerOperation",
            col: "col-2",
          },
        ],
      },
    };
  },
};
</script>

