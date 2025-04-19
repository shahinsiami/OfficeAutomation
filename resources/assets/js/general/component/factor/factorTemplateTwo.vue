<template>
  <section>
    <div class="d-flex flex-column my-5 border">
      <!-----------------------------------------title------------------------------------------------->
      <div class="title text-center w-100 row-width">صورتحساب فروش کالا و خدمات</div>
      <!---->
      <div class="w-100 d-flex flex-row justify-content-between row-width">
        <div class="m-3" style="direction: rtl">
          <span class="factor-title">شماره:</span>
          <span class="factor-attribute">{{seller.id}}</span>
        </div>
        <div class="m-3" style="direction: rtl">
          <span class="factor-title">تاریخ:</span>
          <span class="factor-attribute">{{this.date}}</span>
        </div>
      </div>
      <!-----------------------------------------title------------------------------------------------->
      <!-----------------------------------------seller------------------------------------------------->
      <div class="title text-center w-100 row-width">مشخصات فروشنده</div>
      <!---->
      <div class="row row-width contain" v-if="seller.store !== undefined">
        <div class="col-lg-12">
          <div class="d-flex flex-row">
            <div class="col-lg-4 text-right">
              <div class="d-flex flex-column">
                <div class="my-2">
                  <span class="factor-title">نام شخص حقیقی/حقوقی:</span>
                  <span class="factor-attribute">آویژه</span>
                </div>
                <div class="my-2">
                  <span class="factor-title">نشانی:</span>
                  <span
                    class="factor-attribute"
                  >تهران - الهیه - خیابان مهدیه - ابتدای جبهه - پلاک 19</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column">
                <div class="my-2" v-if="seller.storeevidence.type === 'حقوقی'">
                  <span class="factor-title">شماره اقتصادی:</span>
                  <span class="factor-attribute">411587371979</span>
                </div>
                <div class="my-2">
                  <span class="factor-title">کدپستی:</span>
                  <span class="factor-attribute">1915979711</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column">
                <div class="my-2" v-if="seller.storeevidence.type === 'حقوقی'">
                  <span class="factor-title">شماره ثبت:</span>
                  <span class="factor-attribute">515900</span>
                </div>
                <div class="my-2" v-if="seller.storeevidence.type === 'حقوقی'">
                  <span class="factor-title">شماسه ملی:</span>
                  <span class="factor-attribute">14007089082</span>
                </div>
                <div class="my-2">
                  <span class="factor-title">تلفن های تماس:</span>
                  <span class="factor-attribute">26643270</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-----------------------------------------seller------------------------------------------------->
      <!-----------------------------------------buyer------------------------------------------------->
      <div class="title text-center w-100 row-width">مشخصات خریدار</div>
      <div class="row row-width" v-if="seller.store !== undefined">
        <div class="col-lg-12">
          <div class="d-flex flex-row">
            <div class="col-lg-4 text-right">
              <div class="d-flex flex-column">
                <div class="my-2">
                  <span class="factor-title">نام شخص حقیقی/حقوقی:</span>
                  <span class="factor-attribute">{{seller.store.name}}</span>
                </div>
                <div class="my-2">
                  <span class="factor-title">نشانی:</span>
                  <span class="factor-attribute">{{seller.storeevidence.address}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column">
                <div class="my-2" v-if="seller.storeevidence.type === 'حقوقی'">
                  <span class="factor-title">شماره اقتصادی:</span>
                  <span class="factor-attribute">{{seller.storeevidence.economiccode}}</span>
                </div>
                <div class="my-2">
                  <span class="factor-title">کدپستی:</span>
                  <span class="factor-attribute">{{seller.storeevidence.postcode}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-column">
                <div class="my-2" v-if="seller.storeevidence.type === 'حقوقی'">
                  <span class="factor-title">شماره ثبت:</span>
                  <span class="factor-attribute">{{seller.storeevidence.companynumber}}</span>
                </div>
                <div class="my-2" v-if="seller.storeevidence.type === 'حقوقی'">
                  <span class="factor-title">شماسه ملی:</span>
                  <span class="factor-attribute">{{seller.storeevidence.companynationalcode}}</span>
                </div>
                <div class="my-2">
                  <span class="factor-title">تلفن های تماس:</span>
                  <span class="factor-attribute">{{seller.storeevidence.phonenumber}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-----------------------------------------buyer------------------------------------------------->
      <!-----------------------------------------product------------------------------------------------->
      <div class="title text-center w-100 row-width">مشخصات کالا</div>
      <div class="container-fluid">
        <div class="row row-width" style="direction:ltr">
          <div class="title-table text-center col-2">مبلغ کل</div>
          <div class="title-table text-center col-1">عوارض و مالیات</div>
          <div class="title-table text-center col-1">تخفیف</div>
          <div class="title-table text-center col-1">مبلغ واحد</div>
          <div class="title-table text-center col-1">تعداد</div>
          <div class="title-table text-center col-5">شرح کالا</div>
          <div class="title-table text-center col-1">ردیف</div>
        </div>
      </div>
      <!-----------------------------------------product------------------------------------------------->
      <!-----------------------------------------product------------------------------------------------->
      <div class="container-fluid">
        <div class="row row-width" style="direction:ltr">
          <div class="table-attribute text-center col-2">{{seller.finalprice}}</div>
          <div class="table-attribute text-center col-1">{{seller.valueadded}}</div>
          <div class="table-attribute text-center col-1">{{seller.irdprice}}</div>
          <div class="table-attribute text-center col-1">{{seller.irprice}}</div>
          <div class="table-attribute text-center col-1">1</div>
          <div
            class="title-table text-center col-5"
            v-if="seller.product !== undefined"
          >{{seller.product.name}}</div>
          <div class="table-attribute text-center col-1">1</div>
        </div>
      </div>

      <!-----------------------------------------product-------------------------------------------------->
      <!-----------------------------------------sum------------------------------------------------->
      <div class="container-fluid">
        <div class="row row-width sum" style="direction:ltr">
          <div class="table-attribute text-center col-2">{{seller.finalprice}}</div>
          <div class="table-attribute text-center col-1">{{seller.valueadded}}</div>
          <div class="table-attribute text-center col-1">{{seller.irdprice}}</div>
          <div class="table-attribute text-center col-1">{{seller.irprice}}</div>
          <div class="table-sum text-center col-7 p-3">جمع کل</div>
        </div>
      </div>

      <!-----------------------------------------sum------------------------------------------------->
      <!-----------------------------------------sign------------------------------------------------->
      <div class="row m-1">
        <div class="col-lg-6 text-right border py-5">
          <span class="sign">مهر و امضاء خریدار</span>
        </div>
        <div class="col-lg-6 text-right border py-5">
          <span class="sign">مهر و امضاء فروشنده</span>
        </div>
      </div>
      <!-----------------------------------------sign------------------------------------------------->
    </div>
  </section>
</template>
<!---->
<style>
.title {
  font-family: IRANSans;
  font-weight: bold;
  font-size: 0.9em;
  color: #0b2e13;
  background-color: #eaeaea;
  height: 35px;
  align-items: center;
  padding-top: 8px;
}

.factor-title {
  font-family: IRANSans;
  font-size: 0.9em;
  color: #3b3b3b;
}

.factor-attribute {
  font-family: IRANSans;
  font-size: 0.8em;
  color: #4f4f4f;
}

.title-table {
  font-family: IRANSans;
  font-weight: bold;
  font-size: 0.8em;
  color: #3b3b3b;
  border: 1px solid gray;
  direction: rtl;
  text-align: right;
}

.table-attribute {
  font-family: IRANSans;
  font-size: 0.8em;
  color: #3b3b3b;
  border: 1px solid gray;
  direction: rtl;
  text-align: right;
}

.table-sum {
  font-family: IRANSans;
  font-size: 0.8em;
  color: #3b3b3b;
  direction: rtl;
  text-align: right;
  border: 1px solid #3b3b3b;
}
.sum {
  height: 50px;
  background-color: #f3f3f3;
}
.sign {
  font-family: IRANSans;
  font-size: 1.1em;
}
</style>
<script>
export default {
  name: "factorTemplateTwo",
  props: ["seller", "date"]
};
</script>
