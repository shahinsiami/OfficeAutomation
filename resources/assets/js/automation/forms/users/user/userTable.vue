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
  name: "userTable",
  data() {
    return {
      window: {
        headerid: "userTable",
        title: "کاربران"
      },
      table: {
        selectStore: "userStore",
        getData: "userTable",
        openSelectRow: ["automation", "userEdit",'کاربران'],
        selectRow: "selectUserEdit",
        deleteRow: "/api/v1/deleteUser/",
        excel: "/api/v1/excelSubCategory",
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
            headerTitle: "نام",
            searchable: "true"
          },
          {
            title: "user_permission",
            relation: "name",
            type: "manyRelation",
            headerType: "headerTitle",
            headerTitle: "مجوز",
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
            type: "operatoin",
            headerType: "headerOperation",
            col: "col-4"
          }
        ]
      }
    };
  },
  //model
};
</script>

