<template>
  <div class="content">
    <div class="row p-2">
      <div class="col-6 d-flex flex-row justify-content-center align-items-center"></div>
      <div class="col-6">
        <windowHeader :windowTitle="this.window.title" :windowTitleLine="this.window.titleLine"></windowHeader>
      </div>
    </div>
    <windowTableWithoutExcel
      :selectStore="this.table.selectStore"
      :getData="this.table.getData"
      :tableColumn="this.table.column"
      :fileName="this.table.fileNmae"
      :selectRow="this.table.selectRow"
      :openSelectRow="this.table.openSelectRow"
      :deleteRow="this.table.deleteRow"
      firstColumnSearch="id"
    ></windowTableWithoutExcel>
  </div>
</template>
<style scoped>
</style>


<script>
export default {
  name: "userInfoTable",
  data() {
    return {
      window: {
        headerid: "userInfoTable",
        title: "مشخصات"
      },
      table: {
        selectStore: "userStore",
        getData: "userInfoTable",
        openSelectRow: ["automation", "userInfoEdit",'ویرایش مشخصات'],
        selectRow: "selectUserInfoEdit",
        deleteRow: "",
        excel: "",
        fileNmae: "subCategories.xls",
        column: [
          {
            title: "id",
            type: "number",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "شماره",
            searchable: "true"
          },
          {
            title: "name",
            type: "string",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "نام کاربری",
            searchable: "true"
          },
          {
            title: "userinfo",
            relation: "name",
            type: "relation",
            headerType: "headerTitle",
            headerTitle: "نام",
            col: "col-2"
          },
          {
            title: "userinfo",
            relation: "family",
            type: "relation",
            headerType: "headerTitle",
            headerTitle: "نام خانوادگی",
            col: "col-2"
          },
          {
            title: "created_at",
            type: "date",
            headerType: "headerOrder",
            col: "col-2",
            headerTitle: "تاریخ ایجاد"
          },
          {
            title: "operation",
            type: "operatoinWithoutDelete",
            headerType: "headerOperation",
            col: "col-2"
          }
        ]
      }
    };
  },
  ///////////////////////////////////////////////////////////////////////model
};
</script>

