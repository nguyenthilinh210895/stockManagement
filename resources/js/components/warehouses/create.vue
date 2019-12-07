<template>
  <section class="wrapper site-min-height">
    <section class="panel">
      <header class="panel-heading">Thêm kho hàng</header>
      <div class="panel-body">
         <div class="col-md-11 offset-1 clearfix">
          <div class="form-group-cs d-flex">
            <div class="col-md-2">
              <label for="name" class="label-size-20">Khu vực</label>
            </div>
            <div class="col-md-8">
              <select
              class="form-control cs-select-form"
              name="area"
              v-model="warehouse.area"
            >
              <option v-for="area in area" :value="area.id">{{ area.area_name }}</option>
            </select>
                <p class="errMessage" v-if="errors.area">{{ errors.area[0]}}</p>

            </div>
          </div>
        </div>


        <div class="col-md-11 offset-1 clearfix">
          <div class="form-group-cs d-flex">
            <div class="col-md-2">
              <label for="name" class="label-size-20">Tên kho</label>
            </div>
            <div class="col-md-8">
              <input
                type="text"
                id="name"
                class="form-control label-size-19"
                name="warehouse_name" placeholder="Nhập tên kho"
                v-model="warehouse.warehouse_name" required
              />
                <p class="errMessage" v-if="errors.warehouse_name">{{ errors.warehouse_name[0]}}</p>

            </div>
          </div>
        </div>

        <div class="col-md-11 offset-1 clearfix">
          <div class="form-group-cs d-flex">
            <div class="col-md-2">
              <label for="manager" class="label-size-20">Người quản lý</label>
            </div>
            <div class="col-md-8">
              <input
                type="text"
                id="manager"
                class="form-control label-size-19"
                name="ware_manager"  placeholder="Nhập tên người quản lý"
                v-model="warehouse.ware_manage"
              />
                <p class="errMessage" v-if="errors.ware_manage">{{ errors.ware_manage[0]}}</p>

            </div>
          </div>
        </div>
        <div class="col-md-11 offset-1 clearfix">
          <div class="form-group-cs d-flex">
            <div class="col-md-2">
              <label for="phone" class="label-size-20">Điện thoại</label>
            </div>
            <div class="col-md-8">
              <input
                type="text"
                id="phone"
                class="form-control label-size-19"
                name="ware_phone"  placeholder="Nhập số điệnt thoại"
                v-model="warehouse.ware_phone"
              />
                <p class="errMessage" v-if="errors.ware_phone">{{ errors.ware_phone[0]}}</p>

            </div>
          </div>
        </div>
        <div class="col-md-11 offset-1 clearfix">
          <div class="form-group-cs d-flex">
            <div class="col-md-2">
              <label for="email" class="label-size-20">Email</label>
            </div>
            <div class="col-md-8">
              <input
                type="text"
                id="email"
                class="form-control label-size-19"
                name="ware_email"  placeholder="Nhập địa chỉ Email"
                v-model="warehouse.ware_email"
              />
                <p class="errMessage" v-if="errors.ware_email">{{ errors.ware_email[0]}}</p>

            </div>
          </div>
        </div>
          <div class="col-md-11 offset-1 clearfix">
              <div class="form-group-cs d-flex">
                  <button style="margin-left: 40%;" @click="handleCreate">Lưu</button>
              </div>
          </div>
      </div>
    </section>
  </section>
</template>
<script>
export default {
  name: "warehouse-create",
  props: {
    area: { type: Array, required: true }
  },
  data() {
    return {
      warehouse: {
        warehouse_name: "",
        ware_manage: "",
        ware_phone: "",
        ware_email: "",
        area: '',
      },
      errors: [],
    };
  },
  methods: {
    handleCreate() {
      let formData = new FormData();
      formData.append("warehouse_name", this.warehouse.warehouse_name);
      formData.append("ware_manage", this.warehouse.ware_manage);
      formData.append("ware_phone", this.warehouse.ware_phone);
      formData.append("ware_email", this.warehouse.ware_email);
      formData.append("area", this.warehouse.area);

      axios.post("/api/warehouses", formData)
        .then(res => {
          localStorage.setItem(res.data.message.status, res.data.message.content);
          window.location.href = res.data.url;
          this.errors = [];
        })
        .catch(error => {
            console.log(this.error);
          this.errors = error.response.data.error;

        });
    }
  }
};
</script>

<style lang="scss" scoped>
.form-group-cs {
  padding-top: 20px;
}
</style>
